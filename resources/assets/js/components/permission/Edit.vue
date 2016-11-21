<template>
<div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>权限管理</h2>
			<ol class="breadcrumb">
				<li>
					<router-link to="/dash">
					<i class="fa fa-dashboard"></i> Home
					</router-link>
				</li>
				<li>
					<router-link :to="{name: 'permission'}">
					<i class="fa fa-diamond"></i> 权限列表
					</router-link>
				</li>
				<li class="active">
					<strong><i class="fa fa-edit"></i> 修改权限</strong>
				</li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>修改权限</h5>
					</div>
					<div class="ibox-content">
						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-2 control-label">权限名称</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.name" placeholder="权限名称">
									<span class="help-block m-b-none text-danger">{{ errors.name }}</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">权限</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.slug" placeholder="权限">
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
								<label class="col-sm-2 control-label">模型</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.model" placeholder="模型">
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<router-link to="/permission" tag="span">
									<a class="btn btn-white"><i class="fa fa-reply"></i> 返回</a>
									</router-link>
									<button class="btn btn-primary" @click="editPermission"><i class="fa fa-paper-plane-o"></i> 提交</button>
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
					slug:'',
					description:'',
					model:''
				},
				errors: {
					name: '',
					slug: ''
				},
				permission_id: 0
			}
		},
		created () {
			this.permission_id = this.$route.params.id
			this.fetchData()
		},
		methods: {
			fetchData() {
				var url = '/api/permission/'+ this.permission_id +'/edit'
				this.$http.get(url)
					.then(response => {
						console.log(response)
						if (response.data.status) {
							this.formData = response.data.responseData
						}else{
							this.$message({
								showClose: true,
								message: msg,
								type: 'error',
								onClose: function () {
									this.$router.push({name: 'permission'})
								}
							})
						}
					},response => {
						this.$message({
		          showClose: true,
		          message: '好像哪里出错了~刷新一下！',
		          type: 'error'
		        });
					})
			},
			editPermission() {
				this.$http.put('/api/permission/' + this.permission_id,this.formData)
					.then(response => {
						// console.log(response)
						this.messgeClose(response.data.status,response.data.msg,this.$router)
					},response =>  {
						if (response.status == 422) {
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
						router.push({name: 'permission'})
					}
				})
			}
		}
	}
</script>