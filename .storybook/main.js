const path = require('path');

/** @type { import('@storybook/html-webpack5').StorybookConfig } */
const config = {
	stories: [
		'../src/blocks/**/*.stories.@(js)',
		'../templates/components/**/*.stories.@(js)',
	],
	staticDirs: ['../dist'],
	addons: [
		'@storybook/addon-webpack5-compiler-swc',
		'@storybook/addon-links',
		'@storybook/addon-essentials',
		'@chromatic-com/storybook',
		'@storybook/addon-interactions',
	],
	framework: {
		name: '@storybook/html-webpack5',
		options: {},
	},
	docs: {
		autodocs: 'tag',
	},
	webpackFinal: async (config, { configType }) => {
		config.module.rules.push({
			test: /\.twig$/,
			use: ['twigjs-loader'],
		});

		config.resolve.modules = [
			...(config.resolve.modules || []),
			path.resolve(__dirname, '../src/blocks'),
			path.resolve(__dirname, '../templates/components'),
			path.resolve(__dirname, '../templates/parts'),
		];

		return config;
	},
};

export default config;
