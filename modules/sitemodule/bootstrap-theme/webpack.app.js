const Path = require('path');
const WebpackCleanupPlugin = require('webpack-cleanup-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const webpack = require('webpack');
const WebpackNotifierPlugin = require('webpack-notifier');
const WebpackAssetsManifest = require('webpack-assets-manifest');

const env = process.env.NODE_ENV;

module.exports = {
  mode: env,
  devtool: env == 'development' ? 'source-map' : false,
  entry: {
    app: Path.resolve(__dirname, 'src/assets/src/app.js')
  },
  output: {
    path: Path.resolve(__dirname, 'src/assets/dist/app')
  },
  optimization: {
    moduleIds: 'hashed',
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /[\\/]node_modules[\\/]/,
          chunks: 'all',
          filename: '[name].js'
        }
      }
    }
  },
  plugins: [
    new WebpackAssetsManifest(),
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[name].css',
    }),
    new WebpackNotifierPlugin(),
    new WebpackCleanupPlugin()
  ],
  module: {
    rules: [
      {
        test: /\.mjs$/,
        include: /node_modules/,
        type: 'javascript/auto'
      },
      {
        test: /\.(jpg|png|gif|jpeg)$/,
        loader: 'image-webpack-loader',
        enforce: 'pre',
        options: {
          webp: {
            quality: 100
          }
        }
      },
      {
        test: /\.woff(\?.*)?$/,
        loader: "url-loader?limit=10000&mimetype=application/font-woff&name=[path][name].[ext]"
      }, {
        test: /\.woff2(\?.*)?$/,
        loader: "url-loader?limit=10000&mimetype=application/font-woff&name=[path][name].[ext]"
      }, {
        test: /\.ttf(\?.*)?$/,
        loader: "url-loader?limit=10000&mimetype=application/octet-stream&name=[path][name].[ext]"
      }, {
        test: /\.eot(\?.*)?$/,
        loader: "file-loader?name=[path][name].[ext]"
      }, {
        test: /\.svg(\?.*)?$/,
        loader: "url-loader?limit=10000&mimetype=image/svg+xml&name=[path][name].[ext]"
      }, {
        test: /\.(ico|jpg|jpeg|png|gif)(\?.*)?$/,
        loader: 'url-loader?name=[path][name].[ext]&limit=0'
      }, {
        test: /\.js$/,
        exclude: /node_modules/,
        enforce: 'pre',
        loader: 'eslint-loader',
        options: {
          emitWarning: false
        }
      }, {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader'
      }, {
        test: /\.(css|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              sourceMap: (env == 'development')
            }
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: (env == 'development'),
              sassOptions: {
                outputStyle: 'expanded'
              }
            }
          },
          // {
          //   loader: 'sass-resources-loader',
          //   options: {
          //     resources: [
          //       Path.resolve(__dirname, 'src/assets/src/scss/resources.scss'),
          //       Path.resolve(__dirname, 'src/assets/src/scss/mixins.scss'),
          //     ]
          //   },
          // }
        ]
      }
    ]
  }
}