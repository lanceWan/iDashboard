<template>
<div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>用户管理</h2>
			<ol class="breadcrumb">
				<li>
					<router-link to="/dash">
					<i class="fa fa-dashboard"></i> Home
					</router-link>
				</li>
				<li>
					<router-link :to="{name: 'user'}">
					<i class="fa fa-diamond"></i> 用户列表
					</router-link>
				</li>
				<li class="active">
					<strong><i class="fa fa-edit"></i> 用户信息</strong>
				</li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>用户信息</h5>
					</div>
					<div class="ibox-content">
						<form class="form-horizontal" @submit.prevent>
							<div class="form-group">
								<label class="col-sm-2 control-label">用户名称</label>
								<div class="col-sm-10">
									<p class="form-control-static">{{formData.name}}</p>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">用户名</label>
								<div class="col-sm-10">
									<p class="form-control-static">{{formData.username}}</p>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">邮箱</label>
								<div class="col-sm-10">
									<p class="form-control-static">{{formData.email}}</p>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
	            <div class="form-group">
	              <label class="col-sm-2 control-label">角色</label>
	              <div class="col-sm-10">
		                <label class="checkbox-inline" v-for="role of formData.roles">
									  	<span>{{role}}</span>
									  </label>
	              </div>
	            </div>
							<div class="hr-line-dashed"></div>
	            <div class="form-group">
	              <label class="col-sm-2 control-label">分配额外权限</label>
	              <div class="col-sm-10">
	                <div class="ibox float-e-margins">
	                  <table class="table table-bordered" v-loading="loading" element-loading-text="拼命加载中...">
	                    <thead>
	                      <tr>
	                          <th class="col-md-1 text-center">模块</th>
	                          <th class="col-md-10 text-center">权限</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                      <template v-for="(permission,key) in formData.permissions">
												  <tr>
												  	<td>{{key}}</td>
												  	<td>
												  		<div class="col-md-4" v-for="item of permission">
			                     			<span>{{item.name}}</span>
			                      	</div>
												  	</td>
												  </tr>
												</template>
	                    </tbody>
	                  </table>
	                </div>
	              </div>
	            </div>
	            <div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<router-link :to="{name:'user'}" tag="span">
									<a class="btn btn-white"><i class="fa fa-reply"></i> 返回</a>
									</router-link>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
	export default {
		data () {
			return {
				formData: {
					name:'',
					username:'',
					email:'',
					permissions:{},
					roles:{},
				},
				user_id:0,
				loading: true,
			}
		},
		created () {
			this.user_id = this.$route.params.id
			this.fetchData()
		},
		methods: {
			fetchData() {
				var _this = this
				this.$http.get('/api/user/'+ this.user_id)
					.then(response => {
						this.formData = response.data.user
						this.loading = false
					},response => {
						this.$message({
							showClose: true,
							message: '好像哪里出错了!',
							type: 'error',
							onClose: function () {
								_this.$router.push({name: 'user'})
							}
						})
					})
			},
		}
	}
</script>