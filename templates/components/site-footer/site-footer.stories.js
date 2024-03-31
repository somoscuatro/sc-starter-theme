import twigTemplate from './template.twig';

export default {
	title: 'Components/Site Footer',
	tags: ['autodocs'],
	argTypes: {
		copyright_text: {
			description:
				'The copyright text to display. If not provided, the default copyright text will be displayed.',
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
	copyright_text: `&copy; ${new Date().getFullYear()} Starter Theme by <a class="underline" href="https://somoscuatro.es">somoscuatro</a>`,
};
