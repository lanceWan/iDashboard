const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
const User = { template: '<div>user</div>' }
import Example from '../components/Example'
import PermissionList from '../components/permission/List'
import PermissionCreate from '../components/permission/Create'
import PermissionEdit from '../components/permission/Edit'

import RoleList from '../components/role/List'
import RoleCreate from '../components/role/Create'
import RoleEdit from '../components/role/Edit'
import RoleShow from '../components/role/Show'

import UserList from '../components/user/List'

const routes = [
  { path: '/dash', component: Example },
  { path: '/permission', component: PermissionList, name: 'permission'},
  { path: '/permission/create', component: PermissionCreate ,name: 'create-permission'},
  { path: '/permission/:id/edit', component: PermissionEdit, name: 'edit-permission' },
  { path: '/role', component: RoleList, name: 'role' },
  { path: '/role/:id', component: RoleShow, name: 'show-role' },
  { path: '/role/create', component: RoleCreate, name: 'create-role' },
  { path: '/role/:id/edit', component: RoleEdit, name: 'edit-role' },
  { path: '/user', component: UserList, name: 'user' },
  { path: '*', redirect: '/dash' }
]

export default routes