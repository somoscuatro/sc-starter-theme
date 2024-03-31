/** @type { import('@storybook/html').Preview } */

import Twig from 'twig';

import '../dist/styles/main.css';

const preview = {
	parameters: {
		controls: {
			matchers: {
				color: /(background|color)$/i,
				date: /Date$/i,
			},
		},
		viewport: {
			viewports: {
				xs: {
					name: 'XS',
					styles: {
						width: '390px',
						height: '',
					},
				},
				sm: {
					name: 'SM',
					styles: {
						width: '640px',
						height: '',
					},
				},
				md: {
					name: 'MD',
					styles: {
						width: '768px',
						height: '',
					},
				},
				lg: {
					name: 'LG',
					styles: {
						width: '1024px',
						height: '',
					},
				},
				xl: {
					name: 'XL',
					styles: {
						width: '1280px',
						height: '',
					},
				},
				'2xl': {
					name: '2XL',
					styles: {
						width: '1536px',
						height: '',
					},
				},
			},
		},
	},
};

export default preview;

export const decorators = [
	(Story, context) => {
		// Clear the Twig.js cache for the specific template ID before rendering.
		if (Twig.twig({ ref: 'id' }) === null) {
			Twig.cache();
		}

		return Story();
	},
];
