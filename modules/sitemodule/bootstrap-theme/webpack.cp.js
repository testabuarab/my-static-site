const Path = require('path');
const webpack = require('webpack');
const TerserPlugin = require("terser-webpack-plugin")
const WebpackBar = require("webpackbar")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")

const env = process.env.NODE_ENV;

module.exports = {
  mode: env,
  devtool: env == 'development' ? 'source-map' : false,
  entry: {
    cp: Path.resolve(__dirname, 'cp/src/cp.js')
  },

  output: {
    path: Path.resolve(__dirname, 'cp/dist'),
    publicPath: '',
    filename: "[name].js",
    chunkFilename: "[name].js",
    asyncChunks: false,
    environment: { module: false },
    clean: true
  },

  resolve: {
    modules: [ "node_modules" ]
  },

  plugins: [
    new WebpackBar({ fancy: true, profile: true }),
    new MiniCssExtractPlugin({
      filename: "[name].css"
    }),
  ],

  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ["@babel/preset-env", {
                  targets: { browsers: ["safari >= 7"] },
                  bugfixes: true,
                  modules: false,
                  useBuiltIns: 'usage',
                  corejs: 3,
                },
              ],
            ],
            plugins: [
              ["@babel/plugin-proposal-class-properties"],
              ["@babel/plugin-transform-runtime", { "corejs": 3 }],
              ["@babel/plugin-syntax-dynamic-import"]
            ],
          },
        }
      },
      {
        test: /\.svg(\?.*)?$/,
        use: [
          "svg-url-loader",
          "svg-transform-loader"
        ]
      },
      {
        test: /\.(scss|css)$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              emit: true
            }
          },
          {
            loader: "css-loader",
            options: {
              importLoaders: 2,
            }
          },
          { loader: "postcss-loader" },
          { loader: "svg-transform-loader/encode-query" },
          {
            loader: "sass-loader",
            options: {
              sourceMap: true,
              implementation: require("sass"),
            }
          },
        ],
      },
      {
        test: /\.(?:ico|gif|png|jpg|jpeg)$/i,
        type: "asset/inline",
        loader: "file-loader",
        options: {
          outputPath: "images",
        },
      },
    ],
  },

  optimization: {
    removeEmptyChunks: true,
    providedExports: true,
    usedExports: true,
    minimize: env == 'production',
    minimizer: [
      new TerserPlugin({
        terserOptions: {
          format: {
            comments: false,
          },
        },
        extractComments: false,
      }),
    ],
  },

}

// module.exports = {
//   mode: env,
//   devtool: env == 'development' ? 'source-map' : false,
//   entry: {
//     cp: Path.resolve(__dirname, 'cp/src/cp.js')
//   },
//   output: {
//     path: Path.resolve(__dirname, 'cp/dist')
//   },
//   optimization: {
//     moduleIds: 'hashed',
//     splitChunks: {
//       cacheGroups: {
//         vendor: {
//           test: /[\\/]node_modules[\\/]/,
//           chunks: 'all',
//           filename: '[name].[hash].js'
//         }
//       }
//     }
//   },
//   plugins: [
//     new WebpackAssetsManifest(),
//     new MiniCssExtractPlugin({
//       filename: '[name].[hash].css',
//       chunkFilename: '[name].css',
//     }),
//     new WebpackNotifierPlugin(),
//     new WebpackCleanupPlugin()
//   ],
//   module: {
//     rules: [
//       {
//         test: /\.mjs$/,
//         include: /node_modules/,
//         type: 'javascript/auto'
//       },
//       {
//         test: /\.(jpg|png|gif|jpeg)$/,
//         loader: 'image-webpack-loader',
//         enforce: 'pre',
//         options: {
//           webp: {
//             quality: 100
//           }
//         }
//       },
//       {
//         test: /\.woff(\?.+)?$/,
//         loader: "url-loader?limit=10000&mimetype=application/font-woff&name=[path][name].[ext]"
//       }, {
//         test: /\.woff2(\?.+)?$/,
//         loader: "url-loader?limit=10000&mimetype=application/font-woff&name=[path][name].[ext]"
//       }, {
//         test: /\.ttf(\?.+)?$/,
//         loader: "url-loader?limit=10000&mimetype=application/octet-stream&name=[path][name].[ext]"
//       }, {
//         test: /\.eot(\?.+)?$/,
//         loader: "file-loader?name=[path][name].[ext]"
//       }, {
//         test: /\.svg(\?.+)?$/,
//         loader: "url-loader?limit=10000&mimetype=image/svg+xml&name=[path][name].[ext]"
//       }, {
//         test: /\.(ico|jpg|jpeg|png|gif)(\?.*)?$/,
//         loader: 'url-loader?name=[path][name].[ext]&limit=10000'
//       }, {
//         test: /\.js$/,
//         exclude: /node_modules/,
//         enforce: 'pre',
//         loader: 'eslint-loader',
//         options: {
//           emitWarning: false
//         }
//       }, {
//         test: /\.js$/,
//         exclude: /node_modules/,
//         loader: 'babel-loader'
//       }, {
//         test: /\.(css|scss)$/,
//         use: [
//           MiniCssExtractPlugin.loader,
//           {
//             loader: 'css-loader',
//             options: {
//               sourceMap: (env == 'development')
//             }
//           },
//           {
//             loader: 'sass-loader',
//             options: {
//               sourceMap: (env == 'development'),
//               sassOptions: {
//                 outputStyle: 'expanded'
//               }
//             }
//           }
//         ]
//       }
//     ]
//   }
// }