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
					<strong><i class="fa fa-plus"></i> 添加权限</strong>
				</li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>权限管理</h5>
					</div>
					<div class="ibox-content">
						<form class="form-horizontal" @submit.prevent>
							<div class="form-group">
								<label class="col-sm-2 control-label">权限名称</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.name" placeholder="权限名称">
									<span v-if="errors.name" class="help-block m-b-none text-danger">{{ errors.name + ''}}</span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">权限</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" v-model="formData.slug" placeholder="权限">
									<span v-if="errors.slug" class="help-block m-b-none text-danger">{{ errors.slug + ''}}</span>
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
									<button class="btn btn-primary" type="button" @click.prevent="createPermission"><i class="fa fa-paper-plane-o"></i> 提交</button>
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
				errors: {}
			}
		},
		methods: {
			createPermission() {
				this.$http.post('api/permission',this.formData)
					.then(response => {
						// console.log(response)
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
						router.push({name: '/permission'})
					}
				})
			}
		},
	}
</script>