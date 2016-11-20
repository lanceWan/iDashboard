<template>
<div id="wrapper">
  <Sidebar></Sidebar>
  <div id="page-wrapper" class="gray-bg">
    <Navbar></Navbar>
    <router-view></router-view>
    <div class="footer">
        <div class="pull-right">
            10GB of <strong>250GB</strong> Free.
        </div>
        <div>
            <strong>Copyright</strong> 晚黎后台 &copy; http://www.iwanli.me
        </div>
    </div>

  </div>
</div>
</template>
<script>
import Sidebar from './layouts/Sidebar'
import Navbar from './layouts/Navbar'
export default {
  // data() {
  //   return {
  //     sidebar: [
  //     	{url: 'foo', title: 'go to foo'},
  //     	{url: 'bar', title: 'go to bar'},
  //     ]
  //   }
  // },
  components: {
  	Sidebar,
    Navbar
  },
  // created() {
  //     this.fetchSidebarMenu()
  //     this.$http.get('/oauth/personal-access-tokens')
  //       .then(response => {
  //           console.log(response.data);
  //       });
  // },
  // methods: {
  //     fetchSidebarMenu() {
  //         this.$http.get('http://idashboard.app/api/user').then(response => {
  //             console.log(response)
  //         });
  //     }
  // }
}
</script>