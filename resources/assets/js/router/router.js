const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
const User = { template: '<div>user</div>' }
import Example from '../components/Example'
import PermissionList from '../components/permission/List'

const routes = [
  { path: '/dash', component: Example },
  { path: '/user', component: Foo },
  { path: '/permission', component: PermissionList },
  { path: '/permission/create', component: Foo },
  { path: '/role', component: User },
  // { path: '/', redirect: '/top' }
]

export default routes