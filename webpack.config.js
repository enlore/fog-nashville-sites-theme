var path = require('path')
var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  entry: {
    main: './main'
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'src/javascripts'),
    publicPath: '/src/javascripts'
  },
  module: {
    loaders: [
      {
        test: /(\.css|\.scss)$/,
        exclude: [path.resolve(__dirname, "node_modules")], 
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: ['css-loader','postcss-loader','sass-loader']
        })
      },
      {
        test: /\.(jpe?g|png|gif)$/i,
        loader: 'file-loader?name=Images/[name].[ext]'
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin("../css/[name].css", {
      allChunks: true
    })
  ]
}
