import { faker } from '@faker-js/faker';

import twigTemplate from './template.twig';

export default {
	title: 'Components/Image',
	tags: ['autodocs'],
	argTypes: {
		image: {
			description:
				'An object representing the image to be displayed. The `url` property is mandatory and should specify the source URL of the image. The `placeholder` property is also mandatory and must be a boolean value; It has to be set to `true` to work in Storybook, indicating that the image is a placeholder when the actual image is not available on the server. The `alt` property is optional and can be used to provide alternative text for the image.',
			type: 'object',
		},
		width: {
			description: 'The width of the image in pixels.',
			type: 'number',
		},
		height: {
			description: 'The height of the image in pixels.',
			type: 'number',
		},
		classes: {
			description:
				'A space-separated list of CSS class names to apply to the button.',
			type: 'string',
		},
	},
};

const Template = (args) => {
	const template = twigTemplate(args);
	return template;
};

export const Default = Template.bind({});
Default.args = {
	image: {
		placeholder: true,
		url: faker.image.urlLoremFlickr({ category: 'abstract' }),
		alt: 'A test image generated with Faker.',
	},
	width: 680,
	height: 453,
};
