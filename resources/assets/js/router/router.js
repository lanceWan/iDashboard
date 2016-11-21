const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
const User = { template: '<div>user</div>' }
import Example from '../components/Example'
import PermissionList from '../components/permission/List'
import PermissionCreate from '../components/permission/Create'

const routes = [
  { path: '/dash', component: Example },
  { path: '/user', component: Foo },
  { path: '/permission', component: PermissionList },
  { path: '/createPermission', component: PermissionCreate },
  { path: '/role', component: User },
  // { path: '/', redirect: '/top' }
]

export default routes