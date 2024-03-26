import * as tailwindColorPalette from './tailwind.colors.json';
import * as tailwindBgColorsSafeList from './tailwind.bg-colors-safelist.json';

module.exports = {
	content: [
		'./src/**/*.{php,twig}',
		'./templates/**/*.twig',
		'./assets/**/*.js',
	],
	theme: {
		container: {
			center: true,
			screens: {
				sm: '640px',
				md: '768px',
				lg: '1024px',
				xl: '1280px',
			},
			padding: {
				DEFAULT: '1rem',
				'2xl': '0',
			},
		},
		extend: {
			fontFamily: {
				jost: ['Jost', 'Helvetica Neue', 'Arial', 'sans-serif'],
				syne: ['Syne', 'Helvetica Neue', 'Arial', 'sans-serif'],
			},
			colors: tailwindColorPalette,
		},
	},
	plugins: [],
	safelist: [...tailwindBgColorsSafeList.colors],
};
