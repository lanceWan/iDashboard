<template>
<div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>角色信息</h2>
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
					<strong><i class="fa fa-search"></i> 角色信息</strong>
				</li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>角色信息</h5>
					</div>
					<div class="ibox-content">
						<form class="form-horizontal" @submit.prevent>
							<div class="form-group">
								<label class="col-sm-2 control-label">角色名称</label>
								<div class="col-sm-10">
									<p class="form-control-static">{{role.name}}</p>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">角色</label>
								<div class="col-sm-10">
									<p class="form-control-static">{{role.slug}}</p>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">描述</label>
								<div class="col-sm-10">
									<p class="form-control-static">{{role.description}}</p>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">等级</label>
								<div class="col-sm-10">
									<p class="form-control-static">{{role.level}}</p>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
	            <div class="form-group">
	              <label class="col-sm-2 control-label">拥有权限</label>
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
	                      <template v-for="(permission,key) in role.permissions">
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
									<a class="btn btn-white" @click="back"><i class="fa fa-reply"></i> 返回</a>
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
				role: {
					name:'',
					slug:'',
					description:'',
					level:'',
					permissions:{},
				},
				loading: true,
				role_id: 0,
			}
		},
		created () {
			this.role_id = this.$route.params.id
			this.fetchData()
		},
		methods: {
			fetchData(){
				var _this = this
				this.$http.get('/api/role/' + this.role_id)
					.then(response => {
						this.role = response.data.role
						this.loading = false
					},response => {
						this.loading = false
						this.$message({
							showClose: true,
							message: '好像哪里出错了!',
							type: 'error',
							onClose: function () {
								_this.$router.go(-1)
							}
						})
					})
			},
			back(){
				this.$router.go(-1)
			}
		}
	}
</script>