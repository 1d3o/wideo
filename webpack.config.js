const path = require('path')
const fs = require('fs-extra')
const CopyWebpackPlugin = require('copy-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const autoprefixer = require('autoprefixer')

module.exports = (env, args) => {

  // Generate Wideo config
  if (!fs.existsSync('./.wideo.json')) {
    const wideo = {
      ignoreFiles: [
        '.wideo.json', 'webpack.config.js', 'README.md', 'package.json', 'package-lock.json', 'yarn.lock', '.gitignore',
        'src', 'build', 'node_modules', 'bower_components', '.git', 'docs', '.editorconfig',
        'docker-compose.yml', '.dockerignore', 'docker', 'cache'
      ]
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

  // Define custom build plugin
  // - create/detroy build path plugin
  plugins.push({
    apply: (compiler) => {
      compiler.hooks.beforeCompile.tap('WideoCleanTheme', (params) => {
        fs.removeSync('./build')
      })
      compiler.hooks.afterCompile.tap('WideoBuildTheme', (params) => {
        if (!isDev) {
          try { fs.mkdirSync('./build') } catch(e) {}
          fs.readdirSync('./').forEach((fileName) => {
            if (!wideoConfig.ignoreFiles.includes(fileName)) {
              fs.copySync(`./${fileName}`, `./build/${fileName}`)
            }
          })
        }
      })
    }
  })
  // - copy webpack plugin for fonts and images
  plugins.push(
    new CopyWebpackPlugin([
      { from: "src/images", to: "images", ignore: ['*.DS_Store'], },
      { from: "src/fonts", to: "fonts", ignore: ['*.DS_Store'], }
    ], {})
  )
  // - mini css extract plugin
  plugins.push(
    new MiniCssExtractPlugin()
  )


  // Define ruleScss
  const ruleScss = {
    test: /\.s?css$/,
    use: [
      MiniCssExtractPlugin.loader,
      {
        loader: 'css-loader',
        options: {
          sourceMap: isDev,
          url: false
        },
      },
      {
        ident: 'postcss',
        loader: 'postcss-loader',
        options: {
          plugins: () => [
            autoprefixer(),
          ],
        },
      },
      {
        loader: 'sass-loader',
        options: {
          sourceMap: isDev,
        },
      },
    ]
  }

  // Define ruleJs
  const ruleJs = {
    test: /\.js$/,
    exclude: /(node_modules|bower_components)/,
    use: {
      loader: 'babel-loader',
      options: {
        presets: [["@babel/preset-env", { modules: false }]],
        plugins: [['@babel/plugin-proposal-class-properties']]
      }
    }
  }
  
  // Default ruleFont
  const ruleFont = {
    test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
    exclude: /images/,  /* dont want svg images from image folder to be included */

    use: [{
      loader: 'file-loader',
      options: {
        name: '[name].[ext]',
        outputPath: 'fonts/'
      }
    }]
  }

  // Default ruleSvg
  const ruleSvg = {
    test: /\.(svg)$/,
    exclude: /fonts/, /* dont want svg fonts from fonts folder to be included */
    use: [{
      loader: 'file-loader',
      options: {
        name: '[name].[ext]',
        outputPath: 'images/',
      }
    }]
  }

  // Final return
  return {
    devtool: isDev ? 'cheap-module-eval-source-map' : false,

    mode: args.mode,
    watch: isDev,
    entry: entry,
    
    output: {
      filename: '[name].js',
      path: path.resolve(__dirname, 'assets')
    },
    module: {
      rules: [ruleFont, ruleScss, ruleJs, ruleSvg]
    },
    plugins: plugins
  }

}
