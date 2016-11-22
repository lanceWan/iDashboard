<template>
<div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>角色管理</h2>
			<ol class="breadcrumb">
				<li>
					<router-link to="/dash">
					<i class="fa fa-dashboard"></i> Home
					</router-link>
				</li>
				<li>
					<router-link :to="{name: 'role'}">
					<i class="fa fa-diamond"></i> 角色列表
					</router-link>
				</li>
				<li class="active">
					<strong><i class="fa fa-edit"></i> 修改角色</strong>
				</li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>角色管理</h5>
					</div>
					<div class="ibox-content">
						<form class="form-horizontal" @submit.prevent>
							<div class="form-group">
								<label class="col-sm-2 control-label">角色名称</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.name" placeholder="角色名称">
									<span class="help-block m-b-none text-danger">{{ errors.name }}</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">角色</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.slug" placeholder="角色">
									<span class="help-block m-b-none text-danger">{{ errors.slug }}</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">描述</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.description" placeholder="描述">
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">等级</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.level" placeholder="等级">
								</div>
							</div>
							<div class="hr-line-dashed"></div>
	            <div class="form-group">
	              <label class="col-sm-2 control-label">分配权限</label>
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
									<button class="btn btn-primary" @click.prevent="createRole" type="button"><i class="fa fa-paper-plane-o"></i> 提交</button>
								</div>
								<p>{{formData.permission}}--11</p>
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
					slug:'',
					description:'',
					level:'',
					permission:["14"]
				},
				errors: {
					name: '',
					slug: ''
				},
				permissions:{},
				role_id: 0,
				loading: true
			}
		},
		created () {
			this.role_id = this.$route.params.id
			this.fetchData()
		},
		methods: {
			createRole() {
				this.$http.post('api/role',this.formData)
					.then(response => {
						// console.log(response)
						this.messgeClose(response.data.status,response.data.msg,this.$router)
					},response =>  {
						if (response.status == 422) {
							this.initErrors()
							var errors = response.data
							for(var itemError in errors){
								if (itemError == 'name') {
									this.errors.name = errors[itemError][0]
								}else{
									this.errors.slug = errors[itemError][0]
								}
							}
						}
					})
			},
			messgeClose(status,msg,router) {
				this.$message({
					showClose: true,
					message: msg,
					type: status ? 'info':'error',
					onClose: function () {
						router.push({name: 'role'})
					}
				})
			},
			fetchData() {
				var _this = this
				var url = '/api/role/' + this.role_id + '/edit'
				this.$http.get(url)
					.then(response => {
						this.permissions = response.data.permissions
						this.formData = response.data.role
						if (response.data.role.permission.length > 0) {
							var arr = [];
							for (var i = 0; i < response.data.role.permission.length; i++) {
								arr[i] = response.data.role.permission[i] +  ''
							}
						}
						this.formData.permission = arr
						this.loading = false
					},response => {
						this.$message({
							showClose: true,
							message: '好像哪里出错了!',
							type: 'error',
							onClose: function () {
								_this.$router.push({name: 'role'})
							}
						})
					})
			},
			initErrors() {
				this.errors.name = '';
				this.errors.slug = '';
			}
		}
	}
</script>