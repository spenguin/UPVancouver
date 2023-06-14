var path = require('path');
var webpack = require('webpack');

module.exports = {
  entry: './js/react/build/Tickets/index.js',
  output: { path: './js/dist', filename: 'tickets.js' },
  module: {
    loaders: [
      {
        test: /.jsx?$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        query: {
          presets: ['es2015', 'react']
        }
      }
    ]
  },
};