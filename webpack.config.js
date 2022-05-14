const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const path = require('path');
const webpack = require("webpack");

const isProduction = process.env.NODE_ENV === "production";

if(isProduction) {
    console.warn("ACHTUNG: Webpack läuft im Produktivmodus! Zur Entwicklung bitte bundle:dev oder watch-bundle verwenden!");
}

module.exports = {
    mode: isProduction ? "production" : "development",
    entry: './assets/app.js',
    output: {
        filename: '../public/js/scripts.js',
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "../public/css/styles.css",
        }),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        })
    ],
    resolve: {
        alias: {
            jquery: "jquery/src/jquery"
        }
    },

    module: {
        rules: [
            {
                test: /\.less$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: "../"
                        }
                    },
                    "css-loader",
                    "less-loader"
                ]
            },
            {
                test: /\.css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: "../"
                        }
                    },
                    "css-loader"
                ]
            }, {
                test: /\.(woff(2)?|ttf|eot|svg|)(\?v=\d+\.\d+\.\d+)?$/,
                type: "asset/inline",
            },
            {
                test: /\.(gif|png|jpe?g|svg)$/i,
                type: "asset/inline",
            }
        ]
    }
};