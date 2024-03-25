import * as tailwindColorPalette from "./tailwind.colors.json";
import * as tailwindBgColorsSafeList from "./tailwind.bg-colors-safelist.json";

module.exports = {
	content: [
		"./src/**/*.{php,twig}",
		"./templates/**/*.twig",
		"./assets/**/*.js",
	],
	theme: {
		extend: {
			fontFamily: {
				jost: ["Jost", "Helvetica Neue", "Arial", "sans-serif"],
				syne: ["Syne", "Helvetica Neue", "Arial", "sans-serif"],
			},
			colors: tailwindColorPalette,
		},
	},
	plugins: [],
	safelist: [...tailwindBgColorsSafeList.colors],
};
