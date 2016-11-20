<template>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="/admin/img/profile_small.jpg" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                         </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
        </ul>
        <el-col :span="24">
			    <el-menu class="el-menu-vertical-demo" default-active="dash" theme="dark" router="router">
			    	<template v-for="item of sidebar">
			      <el-submenu v-if="item.child.length > 0" v-bind:index="item.url">
			        <template slot="title"><i :class="item.icon"></i> {{item.name}}</template>
		          <el-menu-item v-for="i in item.child" v-bind:index="i.url" :route="{path: i.url}">
		          <i :class="i.icon"></i> {{i.name}}
		          </el-menu-item>
			      </el-submenu>
			      <el-menu-item v-else v-bind:index="item.url" :route="{path: item.url}">
                  <i :class="item.icon"></i> {{item.name}}
                  </el-menu-item>
			      </template>
			    </el-menu>
			  </el-col>
    </div>
</nav>
</template>
<script>
	export default {
		data() {
	    return {
	      sidebar: {}
	    }
	  },
	  created () {
	  	this.fetchSidebarMenu()
	  },
	  methods: {
	  	fetchSidebarMenu () {
	  		this.$http.get('http://idashboard.app/api/menu/sidebar').then(response => {
          console.log(response)
          this.sidebar = response.data
        })
	  	}
	  }
	}
</script>
<style>
  .el-menu--dark{
    background-color:#2F4050;
  }
</style>