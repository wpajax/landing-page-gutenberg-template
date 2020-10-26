const TerserPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = [
	{
		mode: process.env.NODE_ENV,
		entry: {
			sidebar: ["./src/js/index.js"],
		},
		output: {
			filename: "[name].js",
			sourceMapFilename: "[name].js.map",
		},
		module: {
			rules: [
				{
					test: /\.(js|jsx)$/,
					exclude: /(node_modules|bower_components)/,
					loader: "babel-loader",
					options: {
						presets: ["@babel/preset-env", "@babel/preset-react"],
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
		devtool: "source-map",
		optimization: {
			minimize: true,
			minimizer: [
				new TerserPlugin({
					terserOptions: {
						ecma: undefined,
						parse: {},
						compress: true,
						mangle: false,
						module: false,
						output: null,
						toplevel: false,
						nameCache: null,
						ie8: false,
						keep_classnames: undefined,
						keep_fnames: false,
						safari10: false,
					},
				}),
			],
		},
	},
	{
		mode: process.env.NODE_ENV,
		entry: {
			style: ["./src/scss/style.scss"],
		},
		output: {},
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
				filename: "template.css",
			}),
		],
	},
];
