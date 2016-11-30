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
					<strong><i class="fa fa-edit"></i> 修改用户</strong>
				</li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>修改用户</h5>
					</div>
					<div class="ibox-content">
						<form class="form-horizontal" @submit.prevent>
							<div class="form-group">
								<label class="col-sm-2 control-label">用户名称</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.name" placeholder="用户名称">
									<span v-if="errors.name" class="help-block m-b-none text-danger">{{ errors.name + '' }}</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">用户名</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.username" placeholder="用户名">
									<span v-if="errors.username" class="help-block m-b-none text-danger">{{ errors.username + '' }}</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">密码</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" v-model="formData.password" placeholder="密码">
									<span v-if="errors.password" class="help-block m-b-none text-danger">{{ errors.password + '' }}</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">邮箱</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.email" placeholder="邮箱">
									<span v-if="errors.email" class="help-block m-b-none text-danger">{{ errors.email + '' }}</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
	            <div class="form-group">
	              <label class="col-sm-2 control-label">角色</label>
	              <div class="col-sm-10">
	                <template>
		                <label class="checkbox-inline">
										  <el-checkbox-group v-model="formData.role">
										    <el-checkbox :label="role.id + ''" v-for="role of roles">{{role.name}}</el-checkbox>
										  </el-checkbox-group>
									  </label>
									</template>
	              </div>
	            </div>
							<div class="hr-line-dashed"></div>
	            <div class="form-group">
	              <label class="col-sm-2 control-label">分配额外权限</label>
	              <div class="col-sm-10">
	                <div class="ibox float-e-margins">
		                <div class="alert alert-warning">
	                    <strong>注意！</strong> 当某个角色的用户需要额外权限时添加。
	                  </div>
	                  <table class="table table-bordered" v-loading="loading" element-loading-text="拼命加载中...">
	                    <thead>
	                      <tr>
	                          <th class="col-md-1 text-center">模块</th>
	                          <th class="col-md-10 text-center">权限</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                      <template v-for="(permission,key) in permissions">
												  <tr>
												  	<td>{{key}}</td>
												  	<td>
												  		<div class="col-md-4" v-for="item of permission">
				                     		<el-checkbox-group v-model="formData.permission">
															    <el-checkbox :label="item.id+''">{{item.name}}</el-checkbox>
															  </el-checkbox-group>
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
									<router-link :to="{name:'role'}" tag="span">
									<a class="btn btn-white"><i class="fa fa-reply"></i> 返回</a>
									</router-link>
									<button class="btn btn-primary" @click.prevent="createUser" type="button"><i class="fa fa-paper-plane-o"></i> 提交</button>
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
					password:'',
					email:'',
					permission:[],
					role:[]
				},
				errors:{},
				permissions:{},
				roles:{},
				user_id:0,
				loading: true,
				dialogVisible:true
			}
		},
		created () {
			this.user_id = this.$route.params.id
			this.fetchData()
		},
		methods: {
			createUser() {
				this.$http.post('api/user',this.formData)
					.then(response => {
						this.messgeClose(response.data.status,response.data.msg,this.$router)
					},response =>  {
						if (response.status == 422) {
							this.errors = {}
							this.errors = response.data
						}
					})
			},
			messgeClose(status,msg,router) {
				this.$message({
					showClose: true,
					message: msg,
					type: status ? 'info':'error',
					onClose: function () {
						router.push({name: 'user'})
					}
				})
			},
			fetchData() {
				var _this = this
				this.$http.get('/api/user/'+ this.user_id +'/edit')
					.then(response => {
						this.permissions = response.data.permissions
						this.roles = response.data.roles
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