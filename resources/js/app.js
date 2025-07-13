
import './bootstrap'
import '../css/app.css'
import { createApp, h } from 'vue'
import { createInertiaApp,Head,Link } from '@inertiajs/vue3'
import Layout from './Layout/Mainlayouts.vue'
import {ZiggyVue} from "../../vendor/tightenco/ziggy"
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faPlay, faPause, faForward, faBackward } from '@fortawesome/free-solid-svg-icons'
library.add(faPlay, faPause, faForward, faBackward)

createInertiaApp({
    title: (title) =>  `${title}`,
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page= pages[`./Pages/${name}.vue`];
    page.default.layout = page.default.layout ||Layout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .component("Head",Head)
      .component("Link",Link)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mount(el)
  },

})
