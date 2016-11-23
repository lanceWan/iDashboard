<template>
<div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><i class="fa fa-diamond"></i> 用户管理</h2>
            <ol class="breadcrumb">
                <li>
                	<router-link to="/dash">
                		<i class="fa fa-dashboard"></i> Home
                	</router-link>
                </li>
                <li class="active">
                    <strong>用户列表</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
			    <div class="title-action">
			    	<router-link :to="{name:'create-user'}" tag="div">
			    		<a class="btn btn-info"><i class="fa fa-plus"></i> 添加用户</a>
			    	</router-link>
			    </div>
			  </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-paper-plane-o"></i>  用户列表</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                          <el-table
                          :data="tableData"
                          v-loading="laoding"
                          element-loading-text="玩命加载中..."
                          border
                          style="width: 100%">
                          <el-table-column
                            prop="id"
                            label="ID"
                            sortable
                            min-width="80">
                          </el-table-column>
                          <el-table-column
                            prop="name"
                            label="呢称"
                            min-width="120">
                          </el-table-column>
                          <el-table-column
                            prop="username"
                            label="用户名"
                            min-width="150">
                          </el-table-column>
                          <el-table-column
                            prop="created_at"
                            label="创建时间"
                            min-width="180">
                          </el-table-column>
                          <el-table-column
                            prop="updated_at"
                            label="修改时间"
                            min-width="180">
                          </el-table-column>
                          <el-table-column
                            inline-template
                            fixed="right"
                            label="操作"
                            min-width="150">
                            <span>
                              <router-link :to="{ name: 'show-role', params: { id: row.id }}">
                                <el-button type="info" size="mini" icon="search">查看</el-button>
                              </router-link>
                              <router-link :to="{ name: 'edit-role', params: { id: row.id }}">
                                <el-button type="warning" size="mini" icon="edit">编辑</el-button>
                              </router-link>
                              <el-button type="danger" size="mini" icon="delete" @click="destroyRole(row)">删除</el-button>
                            </span>
                          </el-table-column>
                        </el-table>
                        <div class="pull-right m-t-md">
                          <el-pagination
                            @size-change="handleSizeChange"
                            @current-change="handleCurrentChange"
                            :current-page="tablePagination.current"
                            :page-sizes="[10, 25, 50, 100]"
                            :page-size="tablePagination.size"
                            layout="total, sizes, prev, pager, next, jumper"
                            :total="tablePagination.total">
                          </el-pagination>
                        </div>
                      </div>
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
	      tableData: [],
	      tablePagination: {
	        current: 1,
	        size: 10,
	        total: 0
	      },
	      laoding:true,
	    }
		},
		created () {

		},
		methods: {
	    fetchData () {
	      this.$http.get('/api/role?current='+this.tablePagination.current+'&size='+this.tablePagination.size).then((response) => {
	        this.tableData = response.data.data
	        this.tablePagination.total = response.data.total
	        this.laoding = false
	      }, (response) => {
	      	// console.log(response.status)
	        this.laoding = false
	        this.$message.error('哪里出错啦！');
	      })
	    },
	    handleSizeChange(val) {
	      this.tablePagination.size = val
	      this.laoding = true
	      this.fetchData()
	    },
	    handleCurrentChange(val) {
	      this.tablePagination.current = val
	      this.laoding = true
	      this.fetchData()
	      // console.log(`当前页: ${val}`);
	    },
	    destroyRole(row) {
	      this.$confirm('此操作将永久删除该角色, 是否继续?', '提示', {
	        confirmButtonText: '确定',
	        cancelButtonText: '取消',
	        type: 'error'
	      }).then(() => {
	        var _this = this
	        this.$http.delete('/api/role/'+row.id)
	          .then((response) => {
	            this.$message({
	              showClose: true,
	              type: 'success',
	              message: response.data.msg,
	              onClose: function () {
	                _this.fetchData()
	              }
	            });
	          },(response) => {
	            this.$message({
	              showClose: true,
	              type: 'error',
	              message: response.data.msg
	            });
	          })
	      })
	    }
	  }
	}
</script>