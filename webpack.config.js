const path = require('path')
const fs = require('fs-extra')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = (env, args) => {
  // Generate Wideo config
  if (!fs.existsSync('./.wideo.json')) {
    const wideo = {
      ignoreFiles: [
        '.wideo.json', 'webpack.config.js', 'README.md', 'package.json', 'package-lock.json', 'yarn.lock', '.gitignore',
        'src', 'build', 'node_modules', 'bower_components', '.git'
      ],
      browserSync: {
        host: 'localhost',
        port: 3000,
        proxy: 'http://localhost:8888'
      }
    }
    fs.writeFileSync('./.wideo.json', JSON.stringify(wideo, null, 2), 'utf8')
  }

  // Load config, variables and entries
  const wideoConfig = require('./.wideo.json')
  const isDev = args.mode == 'development'
  const entry = {}
  const plugins = []
  fs.readdirSync('./src/packs').forEach((fileName) => {
    const key = fileName.split('.')[0]
    if (!entry[key]) entry[key] = []
    entry[key].push(`./src/packs/${fileName}`)
  })
  fs.readdirSync('./src/images').forEach((fileName) => {
    entry[fileName] = `./src/images/${fileName}`
  })

  // Define BrowserSyncPlugin
  if (isDev) plugins.push(new BrowserSyncPlugin(wideoConfig.browserSync))

  // Define custom build plugin
  plugins.push({
    apply: (compiler) => {
      compiler.hooks.beforeCompile.tap('WideoCleanTheme', (params) => {
        fs.removeSync('./build')
      })
      compiler.hooks.afterCompile.tap('WideoBuildTheme', (params) => {
        if (!isDev) {
          fs.mkdirSync('./build')
          fs.readdirSync('./').forEach((fileName) => {
            if (!wideoConfig.ignoreFiles.includes(fileName)) {
              fs.copySync(`./${fileName}`, `./build/${fileName}`)
            }
          })
        }
      })
    }
  })

  // Define ruleImg
  const ruleImg = {
    test: /\.(jpe?g|png|gif|svg)$/i,
    use: [
      {
        loader: 'file-loader',
        options: {
          name: '[name].[ext]'
        }
      },
      {
        loader: 'img-loader',
        options: {
          plugins: !isDev && [
            require('imagemin-gifsicle')({
              interlaced: false
            }),
            require('imagemin-mozjpeg')({
              progressive: true,
              arithmetic: false
            }),
            require('imagemin-pngquant')({
              floyd: 0.5,
              speed: 2
            }),
            require('imagemin-svgo')({
              plugins: [
                { removeTitle: true },
                { convertPathData: false }
              ]
            })
          ]
        }
      }
    ]
  }

  // Define ruleScss
  const ruleScss = {
    test: /\.(css|scss)/,
    use: [
      {
        loader: 'file-loader',
        options: {
          name: '[name].css'
        }
      },
      {
        loader: 'extract-loader',
        options: {
          sourceMap: isDev
        }
      },
      {
        loader: 'css-loader',
        options: {
          sourceMap: isDev
        }
      },
      {
        loader: 'postcss-loader',
        options: {
          sourceMap: isDev,
          plugins: () => [require('autoprefixer')]
        }
      },
      {
        loader: 'sass-loader',
        options: {
          sourceMap: isDev
        }
      }
    ]
  }

  // Define ruleJs
  const ruleJs = {
    test: /\.(js|jsx)/,
    exclude: /(node_modules|bower_components)/,
    use: {
      loader: 'babel-loader',
      options: {
        presets: ['@babel/preset-env'],
        plugins: []
      }
    }
  }
  
  // Default ruleFont
  const ruleFont = {
    test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
    use: [{
      loader: 'file-loader',
      options: {
        name: '[name].[ext]',
        outputPath: 'fonts/'
      }
    }]
  }

  return {
    mode: args.mode,
    watch: isDev,
    entry: entry,
    output: {
      filename: '[name].js',
      path: path.resolve(__dirname, 'assets')
    },
    module: {
      rules: [ruleImg, ruleFont, ruleScss, ruleJs]
    },
    plugins: plugins
  }
}
