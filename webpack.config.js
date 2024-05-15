const path = require("path");
const fs = require("fs-extra");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const autoprefixer = require("autoprefixer");
const TerserWebpackPlugin = require("terser-webpack-plugin");

module.exports = (env, args) => {
  const isDev = args.mode === "development";

  // Generate Wideo config
  const wideoConfigPath = "./.wideo.json";
  if (!fs.existsSync(wideoConfigPath)) {
    const wideoConfig = {
      ignoreFiles: [
        ".wideo.json",
        "webpack.config.js",
        "README.md",
        "package.json",
        "package-lock.json",
        "yarn.lock",
        ".gitignore",
        "src",
        "build",
        "node_modules",
        "bower_components",
        ".git",
        "docs",
        ".editorconfig",
        "docker-compose.yml",
        ".dockerignore",
        "docker",
        "cache",
      ],
    };
    fs.writeFileSync(
      wideoConfigPath,
      JSON.stringify(wideoConfig, null, 2),
      "utf8"
    );
  }

  // Load config, variables and entries
  const wideoConfig = require(wideoConfigPath);
  const entry = {};
  const plugins = [];

  fs.readdirSync("./src/packs").forEach((fileName) => {
    const key = path.parse(fileName).name;
    entry[key] = entry[key] || [];
    entry[key].push(`./src/packs/${fileName}`);
  });

  // Define custom build plugin
  plugins.push({
    apply: (compiler) => {
      compiler.hooks.beforeCompile.tap("WideoCleanTheme", () => {
        fs.removeSync("./build");
      });
      compiler.hooks.afterCompile.tap("WideoBuildTheme", () => {
        if (!isDev) {
          fs.mkdirSync("./build", { recursive: true });
          fs.readdirSync("./").forEach((fileName) => {
            if (!wideoConfig.ignoreFiles.includes(fileName)) {
              fs.copySync(`./${fileName}`, `./build/${fileName}`);
            }
          });
        }
      });
    },
  });

  // Copy webpack plugin for fonts and images
  plugins.push(
    new CopyWebpackPlugin({
      patterns: [
        {
          from: "src/images",
          to: "images",
          globOptions: { ignore: ["*.DS_Store"] },
        },
        {
          from: "src/fonts",
          to: "fonts",
          globOptions: { ignore: ["*.DS_Store"] },
        },
      ],
    })
  );

  // Mini CSS Extract Plugin
  plugins.push(new MiniCssExtractPlugin({ filename: "[name].css" }));

  // Rules definitions
  const rules = [
    {
      test: /\.s?css$/,
      use: [
        MiniCssExtractPlugin.loader,
        { loader: "css-loader", options: { sourceMap: isDev, url: false } },
        {
          loader: "postcss-loader",
          options: {
            postcssOptions: { plugins: [autoprefixer()] },
            sourceMap: isDev,
          },
        },
        { loader: "sass-loader", options: { sourceMap: isDev } },
      ],
    },
    {
      test: /\.js$/,
      exclude: /(node_modules|bower_components)/,
      use: {
        loader: "babel-loader",
        options: {
          presets: [["@babel/preset-env", { modules: false }]],
          plugins: [["@babel/plugin-proposal-class-properties"]],
        },
      },
    },
    {
      test: /\.(woff(2)?|ttf|eot|svg)$/,
      type: "asset/resource",
      generator: {
        filename: "fonts/[name][ext][query]",
      },
      exclude: /src\/images/,
    },
    {
      test: /\.(svg)$/,
      type: "asset/resource",
      generator: {
        filename: "images/[name][ext][query]",
      },
      exclude: /src\/fonts/,
    },
  ];

  return {
    target: "web", // Added target
    devtool: isDev ? "source-map" : false,
    mode: args.mode,
    entry: entry,
    output: {
      filename: "[name].js",
      path: path.resolve(__dirname, "assets"),
      clean: true, // Automatically clean the output directory
    },
    module: { rules: rules },
    plugins: plugins,
    watch: isDev, // Ensure this is only set in dev mode
    optimization: {
      minimize: !isDev,
      minimizer: [
        new TerserWebpackPlugin({
          terserOptions: { compress: { drop_console: !isDev } },
        }),
      ],
    },
  };
};
