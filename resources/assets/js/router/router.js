const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
import Example from '../components/Example'

const routes = [
  { path: '', component: Example },
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar },
  // { path: '/', redirect: '/top' }
]

export default routes