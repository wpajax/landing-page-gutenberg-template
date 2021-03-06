import Sidebar from "./sidebar";

const { __ } = wp.i18n;
const { registerPlugin } = wp.plugins;
const { PluginSidebar, PluginSidebarMoreMenuItem } = wp.editPost;
const { Fragment } = wp.element;

registerPlugin("landing-page-gutenberg-template", {
	icon: (
		<svg
			xmlns="http://www.w3.org/2000/svg"
			height="24"
			viewBox="0 0 24 24"
			width="24"
		>
			<path d="M0 0h24v24H0z" fill="none" />
			<path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z" />
		</svg>
	),
	render: () => {
		return (
			<Fragment>
				<PluginSidebarMoreMenuItem target="landing-page-sidebar">
					{__("Landing Page", "anding-page-gutenberg-template")}
				</PluginSidebarMoreMenuItem>
				<PluginSidebar
					name="landing-page-sidebar"
					title={__("Full Width", "anding-page-gutenberg-template")}
				>
					<Sidebar />
				</PluginSidebar>
			</Fragment>
		);
	},
});
