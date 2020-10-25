const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const BabelMinifyPlugin = require("babel-minify-webpack-plugin");

module.exports = [
	{
		mode: process.env.NODE_ENV,
		entry: {
			sidebar: ["./src/js/index.js"],
		},
		output: {
			filename: "[name].js",
		},
		module: {
			rules: [
				{
					test: /\.(js|jsx)$/,
					exclude: /(node_modules|bower_components)/,
					loader: "babel-loader",
					options: {
						presets: [
							[
								"@babel/preset-env",
								{
									targets: {
										esmodules: true,
									},
								},
							],
							"@babel/preset-react",
						],
						plugins: [
							"@babel/plugin-proposal-class-properties",
							"@babel/plugin-transform-arrow-functions",
						],
					},
				},
			],
		},
		externals: {
			// Use external version of React
			react: "React",
		},
	},
	{
		mode: process.env.NODE_ENV,
		entry: {
			style: ["./src/scss/style.scss"],
		},
		module: {
			rules: [
				{
					test: /\.scss$/,
					exclude: /(node_modules|bower_components)/,
					use: [
						{
							loader: MiniCssExtractPlugin.loader,
						},
						{
							loader: "css-loader",
							options: {
								sourceMap: true,
							},
						},
						"sass-loader",
					],
				},
			],
		},
		plugins: [
			new MiniCssExtractPlugin({
				filename: "[name].css",
			}),
		],
	},
];
