<template>
	<section>
		<!--工具条 过滤表单和新增按钮-->
		<el-col :span="24" class="toolbar" style="padding-bottom: 0px;">
			<el-form :inline="true">
				<el-form-item style="float: right">
					<el-button type="primary" @click="handleAdd()">新增</el-button>
				</el-form-item>
			</el-form>
		</el-col>

		<!--列表-->
		<el-table :data="list" highlight-current-row v-loading="listLoading" style="width: 100%;" border>
			<el-table-column prop="id" label="ID" width="80">
			</el-table-column>
			<el-table-column prop="title" label="标题" >
			</el-table-column>
<!-- 			<el-table-column prop="config" label="配置" width="140">
			</el-table-column> -->
			<el-table-column prop="remark" label="备注" width="130">
			</el-table-column>
			<el-table-column label="操作" min-width="150">
				<template scope="scope">
					<el-button size="small" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
					<el-button type="danger" size="small" @click="handleDel(scope.$index, scope.row)">删除</el-button>
				</template>
			</el-table-column>
		</el-table>

		<!--工具条 批量操作和分页-->
		<el-col :span="24" class="toolbar">
			<el-pagination 
				layout="total, sizes, prev, pager, next" 
				@current-change="handleCurrentChange" 
				@size-change="handleSizeChange" 
				:page-sizes="[10, 20, 30, 40]" 
				:page-size="page_size"
				:total="total" 
				style="float:right;">
			</el-pagination>
		</el-col>

		<!--编辑界面-->
		<el-dialog title="编辑" v-model="editFormVisible" :close-on-click-modal="false">
			<el-form :model="editForm" label-width="120px" :rules="editFormRules" ref="editForm">
				<el-form-item label="标题" prop="title" style="width:86%">
					<el-input v-model="editForm.title" auto-complete="off"></el-input>
				</el-form-item>
				<el-form-item label="配置" prop='config'>
					
<div id="content">
		<b-container style="min-width: 1140px;">
			<b-row class="m-20-0 panel-header">
		        <b-col cols="2">
	        	    <h5>排除</h5>
				    <div role="group">
					    <b-button-group data-toggle="buttons">
						<b-button v-for="btn in buttons" @click="exclude(btn.name,btn.state)" :pressed.sync="btn.state" :variant="btn.variant">
							{{ btn.caption }}
					    	</b-button>
					    </b-button-group>
				    </div>
		        </b-col>
		        <b-col cols="4">
		        	<h5>操作</h5>
				  	<b-button-group>
				    	<b-button variant="success" @click="reset()">重置</b-button>
				    	<b-button variant="info" @click="rand()">余下随机</b-button>
				    	<!-- <b-button  @click="generate()">导出json文件</b-button> -->
					</b-button-group>
		        </b-col>
		       
<!-- 		        <b-col cols="4">
		        	<h5>导入</h5>
		        	<b-form-file v-model="file" accept=".json" variant="success" choose-label="点击上传" @change="fileChange()" style="width:250px;position: absolute;">导入json文件</b-form-file><b-button variant="success" @click="imported" style="    margin-left: 250px;">完成</b-button>
					<br>{{file.name}}
		        </b-col> -->
		    </b-row>
		    <b-row>
		        <b-col>
		        	<div class="top">
			        	<div v-for="( item, index) in pai[2]" @mouseenter="paiMouseenter(2, index, item)"  @mouseleave="paiMouseleave(2, index, item)" class="small-box"  @click="selectPlayerPai(2, index, item)" :class="{ hover: item.hover, active: activePai.player == 2 && activePai.index == index}">
							<span v-if="item.value==-1" style="">?</span>
							<span v-else style="">{{item.value}}</span>
							<span v-show="item.hover && item.value != -1" @click="resetPai(2, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
						</div>
					  	<div style="font-size: 18px;font-weight: bolder;font-style: italic;">3</div>
		        	</div>
		        </b-col>	
		    </b-row>
		    <b-row>
		        <b-col>
		        	<b-row>
		        		<b-col>
				        	<div class="left">
					        	<div v-for="(item, index) in pai[3]" @mouseenter="paiMouseenter(3, index, item)"  @mouseleave="paiMouseleave(3, index, item)" class="small-box" @click="selectPlayerPai(3, index, item)" :class="{ hover: item.hover,active: activePai.player == 3 && activePai.index == index}">
								  	<span v-if="item.value==-1" style="">?</span>
								  	<span v-else style="">{{item.value}}</span>
								  	<span v-show="item.hover && item.value != -1" @click="resetPai(3, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
								</div>
								<div style="font-size: 18px;font-weight: bolder;font-style: italic;position: absolute;right: 0px;top: 360px;">4</div>
				        	</div>
		        		</b-col>
		        		<b-col cols="10" class="all">
		        			<div>
			        			<div @click="chonse(index, item)" v-for="(item, index) in all" class="box" :style="allStyle(item)">
								  <!-- <b-img rounded blank width="100" height="100" blank-color="#777" alt="img" class="m-1" /> -->
								  <span>{{item.value}}</span>
								  <b-badge pill variant="success" style="position: absolute;top: 5px;left: 5px;">{{item.total}}</b-badge>

								  <div  class="imaged" v-show=item.showHun>
							<i @click.stop="over(index, item)" v-show=item.hun style="position:absolute;margin-left:-12px;margin-top: -15px;background:#f0f;width: 26px;height: 26px;">混</i>
							<i @click.stop="open(index, item)" v-show=!item.hun style="position:absolute;margin-left:-12px;margin-top: -15px;background:#0f0;width: 26px;height: 26px;">无</i>
								</div> 
								</div>

								<div class="clear"></div>
								<div style="border: 1px solid #ccc;margin-top: 100px;padding: 20px 0px;border-radius: 5px;position: relative;">
						        	<div v-for="(item, index) in pai[4]" @mouseenter="paiMouseenter(4, index, item)"  @mouseleave="paiMouseleave(4, index, item)" class="small-box" @click="selectPlayerPai(4, index, item)" :class="{ hover: item.hover,active: activePai.player == 4 && activePai.index == index}">
									  	<span v-if="item.value==-1" style="">?</span>
									  	<span v-else style="">{{item.value}}</span>
									  	<span v-show="item.hover && item.value != -1" @click="resetPai(4, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
									</div>
									<div style="font-size: 18px;font-weight: bolder;font-style: italic;position: absolute;top: -30px;">前10只牌</div>
								</div>

							</div>
		        		</b-col>
		        		<b-col>
				        	<div class="right">
					        	<div v-for="(item, index) in pai[1]" @mouseenter="paiMouseenter(1, index, item)"  @mouseleave="paiMouseleave(1, index, item)" class="small-box" @click="selectPlayerPai(1, index, item)" :class="{ hover: item.hover,active: activePai.player == 1 && activePai.index == index}">
								  	<span v-if="item.value==-1" style="">?</span>
								  	<span v-else style="">{{item.value}}</span>
								  	<span v-show="item.hover && item.value != -1" @click="resetPai(1, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
								</div>
								<div style="font-size: 18px;font-weight: bolder;font-style: italic;position: absolute;left: 0px;top: 360px;">2</div>
							</div>
		        		</b-col>
		        	</b-row>
		        </b-col>
		    </b-row>
		    <b-row>
		        <b-col>
		        	<div class="bottom">
		        		<div style="font-size: 18px;font-weight: bolder;font-style: italic;">1</div>
<!-- 		        		<div style="font-size: 18px;font-weight: bolder;font-style: italic;"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></div> -->
			        	<div v-for="(item, index) in pai[0]" @mouseenter="paiMouseenter(0, index, item)"  @mouseleave="paiMouseleave(0, index, item)" class="small-box" @click="selectPlayerPai(0, index, item)" :class="{ hover: item.hover,active: activePai.player == 0 && activePai.index == index}">
							<span v-if="item.value==-1" style="">?</span>
							<span v-else style="">{{item.value}}</span>
							<span v-show="item.hover && item.value != -1" @click="resetPai(0, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
						</div>
					</div>
		        </b-col>	
		    </b-row>
		</b-container>
        <b-modal id="modalTip"
                 ref="modalTip"
                 title="" ok-disabled hide-footer hide-header-close hide-header>
	             {{tip}}    
        </b-modal>
	</div>
				</el-form-item>
				<el-form-item label="备注" prop='remark'>
					<el-input type="textarea" v-model="editForm.remark" auto-complete="off"></el-input>
				</el-form-item>
			</el-form>
			<div slot="footer" class="dialog-footer">
				<el-button @click.native="editFormVisible = false">取消</el-button>
				<el-button type="primary" @click.native="editSubmit" :loading="editLoading">提交</el-button>
			</div>
		</el-dialog>

		<!--新增界面-->
		<el-dialog title="新增" v-model="addFormVisible" :close-on-click-modal="false">
			<el-form :model="addForm" label-width="120px" :rules="addFormRules" ref="addForm">
				<el-form-item label="标题" prop="title" style="width:86%">
					<el-input v-model="addForm.title" auto-complete="off"></el-input>
				</el-form-item>
				<el-form-item label="配置" prop='config'>
<div id="content">
		<b-container style="min-width: 1140px;">
			<b-row class="m-20-0 panel-header">
		        <b-col cols="2">
	        	    <h5>排除</h5>
				    <div role="group">
					    <b-button-group data-toggle="buttons">
						<b-button v-for="btn in buttons" @click="exclude(btn.name,btn.state)" :pressed.sync="btn.state" :variant="btn.variant">
							{{ btn.caption }}
					    	</b-button>
					    </b-button-group>
				    </div>
		        </b-col>
		        <b-col cols="4">
		        	<h5>操作</h5>
				  	<b-button-group>
				    	<b-button variant="success" @click="reset()">重置</b-button>
				    	<b-button variant="info" @click="rand()">余下随机</b-button>
				    	<!-- <b-button  @click="generate()">导出json文件</b-button> -->
					</b-button-group>
		        </b-col>
		       
<!-- 		        <b-col cols="4">
		        	<h5>导入</h5>
		        	<b-form-file v-model="file" accept=".json" variant="success" choose-label="点击上传" @change="fileChange()" style="width:250px;position: absolute;">导入json文件</b-form-file><b-button variant="success" @click="imported" style="    margin-left: 250px;">完成</b-button>
					<br>{{file.name}}
		        </b-col> -->
		    </b-row>
		    <b-row>
		        <b-col>
		        	<div class="top">
			        	<div v-for="( item, index) in pai[2]" @mouseenter="paiMouseenter(2, index, item)"  @mouseleave="paiMouseleave(2, index, item)" class="small-box"  @click="selectPlayerPai(2, index, item)" :class="{ hover: item.hover, active: activePai.player == 2 && activePai.index == index}">
							<span v-if="item.value==-1" style="">?</span>
							<span v-else style="">{{item.value}}</span>
							<span v-show="item.hover && item.value != -1" @click="resetPai(2, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
						</div>
					  	<div style="font-size: 18px;font-weight: bolder;font-style: italic;">3</div>
		        	</div>
		        </b-col>	
		    </b-row>
		    <b-row>
		        <b-col>
		        	<b-row>
		        		<b-col>
				        	<div class="left">
					        	<div v-for="(item, index) in pai[3]" @mouseenter="paiMouseenter(3, index, item)"  @mouseleave="paiMouseleave(3, index, item)" class="small-box" @click="selectPlayerPai(3, index, item)" :class="{ hover: item.hover,active: activePai.player == 3 && activePai.index == index}">
								  	<span v-if="item.value==-1" style="">?</span>
								  	<span v-else style="">{{item.value}}</span>
								  	<span v-show="item.hover && item.value != -1" @click="resetPai(3, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
								</div>
								<div style="font-size: 18px;font-weight: bolder;font-style: italic;position: absolute;right: 0px;top: 360px;">4</div>
				        	</div>
		        		</b-col>
		        		<b-col cols="10" class="all">
		        			<div>
			        			<div @click="chonse(index, item)" v-for="(item, index) in all" class="box" :style="allStyle(item)">
								  <!-- <b-img rounded blank width="100" height="100" blank-color="#777" alt="img" class="m-1" /> -->
								  <span >{{item.value}}</span>
								  <b-badge pill variant="success" style="position: absolute;top: 5px;left: 5px;">{{item.total}}</b-badge>

								  <div  class="imaged" v-show=item.showHun>
							<i @click.stop="over(index, item)" v-show=item.hun style="position:absolute;margin-left:-12px;margin-top: -15px;background:#f0f;width: 26px;height: 26px;">混</i>
							<i @click.stop="open(index, item)" v-show=!item.hun style="position:absolute;margin-left:-12px;margin-top: -15px;background:#0f0;width: 26px;height: 26px;">无</i>
								</div> 

								</div>

								<div class="clear"></div>
								<div style="border: 1px solid #ccc;margin-top: 100px;padding: 20px 0px;border-radius: 5px;position: relative;">
						        	<div v-for="(item, index) in pai[4]" @mouseenter="paiMouseenter(4, index, item)"  @mouseleave="paiMouseleave(4, index, item)" class="small-box" @click="selectPlayerPai(4, index, item)" :class="{ hover: item.hover,active: activePai.player == 4 && activePai.index == index}">
									  	<span v-if="item.value==-1" style="">?</span>
									  	<span v-else style="">{{item.value}}</span>
									  	<span v-show="item.hover && item.value != -1" @click="resetPai(4, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
									</div>
									<div style="font-size: 18px;font-weight: bolder;font-style: italic;position: absolute;top: -30px;">前10只牌</div>
								</div>

							</div>
		        		</b-col>
		        		<b-col>
				        	<div class="right">
					        	<div v-for="(item, index) in pai[1]" @mouseenter="paiMouseenter(1, index, item)"  @mouseleave="paiMouseleave(1, index, item)" class="small-box" @click="selectPlayerPai(1, index, item)" :class="{ hover: item.hover,active: activePai.player == 1 && activePai.index == index}">
								  	<span v-if="item.value==-1" style="">?</span>
								  	<span v-else style="">{{item.value}}</span>
								  	<span v-show="item.hover && item.value != -1" @click="resetPai(1, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
								</div>
								<div style="font-size: 18px;font-weight: bolder;font-style: italic;position: absolute;left: 0px;top: 360px;">2</div>
							</div>
		        		</b-col>
		        	</b-row>
		        </b-col>
		    </b-row>
		    <b-row>
		        <b-col>
		        	<div class="bottom">
		        		<div style="font-size: 18px;font-weight: bolder;font-style: italic;">1</div>
<!-- 		        		<div style="font-size: 18px;font-weight: bolder;font-style: italic;"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></div> -->
			        	<div v-for="(item, index) in pai[0]" @mouseenter="paiMouseenter(0, index, item)"  @mouseleave="paiMouseleave(0, index, item)" class="small-box" @click="selectPlayerPai(0, index, item)" :class="{ hover: item.hover,active: activePai.player == 0 && activePai.index == index}">
							<span v-if="item.value==-1" style="">?</span>
							<span v-else style="">{{item.value}}</span>
							<span v-show="item.hover && item.value != -1" @click="resetPai(0, index, item)" style="position: absolute;width: 50px;height: 50px;background-color: cadetblue;top: 0px;left: 0px;padding: 12px;">×</span>
						</div>
					</div>
		        </b-col>	
		    </b-row>
		</b-container>
        <b-modal id="modalTip"
                 ref="modalTip"
                 title="" ok-disabled hide-footer hide-header-close hide-header>
	             {{tip}}    
        </b-modal>
	</div>

				</el-form-item>
				<el-form-item label="备注" prop='remark'>
					<el-input type="textarea" v-model="addForm.remark" auto-complete="off"></el-input>
				</el-form-item>	
			</el-form>
			<div slot="footer" class="dialog-footer">
				<el-button @click.native="addFormVisible = false">取消</el-button>
				<el-button type="primary" @click.native="addSubmit" :loading="addLoading">提交</el-button>
			</div>
		</el-dialog>
	</section>
</template>

<script>
	import { getM, addM,editM,deleteM} from '../api/api';

	const init = [
			     	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}],
			    	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
			    	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
			    	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
			    	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}]
			    ];

	export default {
		data() {
			return {
				filters: {
				},
				list: [],
				total: 0,
				page: 1,
				page_size: 10,
				listLoading: false,
			   //编辑界面
				editForm: {},
				editFormVisible: false,
				editLoading: false,
				editFormRules: {
					title: [
						{required: true, message: '标题不能为空', trigger: 'blur' },
						{min:1,max:30,message:"标题长度在1-30个字符内"},
					]
				},
				//新增界面
				addForm: {},
				addFormVisible: false,
				addLoading: false,
				addFormRules: {
					title: [
						{required: true, message: '标题不能为空', trigger: 'blur' },
						{min:1,max:30,message:"标题长度在1-30个字符内"},
					]
				},
				selectVisible:false,
				newConfig: {},
				// 麻将测试
				file:'', // 上传导入文件
				buttons: [ // 排除按钮
			        {name:'wind', variant: 'outline-primary', caption: '风', state: false },
			        {name:'flower',variant: 'outline-primary', caption: '花', state: false }
	    		],
				hover: false, 
			    dismissSecs: 10,
			    dismissCountDown: 0,
			    showDismissibleAlert: false,
			    all: [ // 待选择牌
			    ],
			    zhuangOptions:[ // 庄家数值
			        { text: 1, value: 1 },
			        { text: 2, value: 2 },
			        { text: 3, value: 3 },
			        { text: 4, value: 4 },
			    ],
			    zhuangSelected: 1, // 庄家
			    pai: init, // 4位玩家的牌
			    activePai: {},
			    tip: '',
			}
		},
		methods: {
			open(row,column){
			if(this.all[row].total<1){
				this.$message("该牌已选完，请换一个!");return;
			}
			let _this=this;
			this.all.forEach(function(value,index,array){
				if(value.hun){
					_this.all[index].hun=!_this.all[index].hun;
					_this.all[index].total=_this.all[index].total+1;
				}
			})
				this.all[row].total=this.all[row].total-1;
				this.all[row].hun=!this.all[row].hun;
			},
			over(row,column){
				if(this.all[row].total<=4){
					this.all[row].total=this.all[row].total+1;
					this.all[row].hun=!this.all[row].hun;
				}
			},
			///////////////////////////
			//分页 过滤
			handleCurrentChange(val) {
				this.page = val;
				this.getDailyTaskList();
			},
			handleSizeChange(val){
				this.page_size = val;
				this.getDailyTaskList();
			},
			//获取列表
			getList() {
				let para = {
					page: this.page,
					page_size: this.page_size
				};
				this.listLoading = true;
				var _this=this;
				getM(para).then((res) => {
					//初始化类型
					console.log(res);
					this.total = res.data.total;
					this.list = res.data.list;
					this.listLoading = false;
				}).catch(function(err){
				});
			},
			//显示编辑界面
			handleEdit: function (index, row) {
				let nConfig = JSON.parse(row.config);
				this.pai = nConfig.pai;
				this.all = nConfig.all;
				this.buttons = nConfig.exclude;


				this.editFormVisible = true;
				this.editForm = Object.assign({}, row);
			},
			//显示新增界面
			handleAdd: function () {
				this.addFormVisible = true;
				this.reset();
				this.addForm = {
					title: '',
					remark: ''
				};
			},
			//新增提交
			addSubmit: function () {
				let myconfig = {
					pai: this.pai,
					all: this.all,
					exclude: this.buttons
				}
				myconfig = JSON.stringify(myconfig);
				this.addForm.config = myconfig;
				var _this=this;
				this.$refs.addForm.validate((valid) => {
					if (valid) {
						let test=false;
						this.pai.forEach(function(values,index,array){
							values.forEach(function(values1,index1,array){
								if(values1.value==-1){
									test=true;
						        	
								}
							})
						});
						if(test){
							_this.$message({message: '存在麻将未选择',type: 'warning'});
							return false;
						}
						let para = Object.assign({}, this.addForm);
						this.$confirm('确认提交吗？', '提示', {}).then(() => {
							this.addLoading = true;
							addM(para).then((res) => {
								this.addLoading = false;
								this.addFormVisible = false;
								this.getList();
							}).catch(function(err){
								_this.addLoading = false;
				            });
						});
					}
				});
			},
		//编辑提交
			editSubmit: function () {
				var _this = this;
				let myconfig = {
					pai: this.pai,
					all: this.all,
					exclude: this.buttons
				}
				myconfig = JSON.stringify(myconfig);
				this.editForm.config = myconfig;

				this.$refs.editForm.validate((valid) => {
					if (valid) {
						let test=false;
						this.pai.forEach(function(values,index,array){
							values.forEach(function(values1,index1,array){
								if(values1.value==-1){
									test=true;
						        	
								}
							})
						});
						if(test){
							_this.$message({message: '存在麻将未选择',type: 'warning'});
							return false;
						}
						let para = Object.assign({}, this.editForm);
						this.$confirm('确认提交吗？', '提示', {}).then(() => {
							this.editLoading = true;
							editM(para).then((res) => {
								this.editLoading = false;
								this.editFormVisible = false;
								this.getList();
							})						
							.catch(function(err){
								_this.editLoading = false;
				            });
						});
					}
				});
			},
		//删除提交
			handleDel: function (index, row) {
				var _this = this;
				this.$confirm('确认删除该记录吗?', '提示', {
					type: 'warning'
				}).then(() => {
					this.listLoading = true;
					let para = { id: row.id };
					deleteM(para).then((res) => {
						this.listLoading = false;
						this.getList();
					})							
					.catch(function(err){
						_this.listLoading = false;
		            });
				});
			},

			reset(){
	  			// reset 所有牌
	  			this.all.splice(0,this.all.length);
				for (var i=0;i<42;i++){
					var color = '#373e40';
					var showHun = true;
					var total = 4;
		    		if (i >=0 && i <=8) {
		    			color = '#a2b4ba';
		    		}else if (i >8 && i <=17) {
		    			color = '#373e40';
		    		}else if (i >17 && i <=26) {
		    			color = '#82abba';
		    		}else if (i > 26 && i <= 30) {
		    			color = '#00b0f0';	
		    		}else if (i > 30 && i <= 33) {
		    			color = '#00b38c';
		    		}else if (i > 33 && i <= 41) {
		    			total = 1;
		    			color = '#ccc';	
		    			showHun = false;
		    		}
					this.all.push({realValue: i, value: this.map(i), color: color, total: total, hun:false,showHun:showHun});
				}
				this.pai = [
			     	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}],
			    	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
			    	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
			    	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
			    	[{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}]
			    ];
				this.zhuangSelected = 1;
				this.buttons[0].state = false;
				this.buttons[1].state = false;
				this.activePai = {player: 0, index: 0};
	  		},
	  		exclude(val,state){
	  			var _this=this;
	  			if(val=="wind"){
	  				if(state==true){
	  					// 获取需要移除的key
	  					var keys = [];
	  					this.all.forEach(function(subItem, subIndex, array){
	  						if(subItem.value=='东' || subItem.value=="西" || subItem.value=="南" || subItem.value=="北"){
								keys.push(subIndex);
	  						};
	  					});

	  					// 移除排除的牌
	  					_this.all.splice(keys[0],4);

	  					//移除手牌
	  					for(var i=0;i<=4;i++){
							for(var j=0;j<=this.pai[i].length-1;j++){
								var pai=this.pai[i][j].value;
								if(pai=='东' || pai=="西" || pai=="南" || pai=="北"){
									_this.pai[i][j].value = -1;
								};
	  						};
	  					}  
	  				}else{
	  					//恢复风
	  					for(var i=27;i<=30;i++){
	  						_this.all.splice(i,0,{realValue: i, value: this.map(i), color: "#00b0f0", total: 4, hun: false, showHun: true});
	  					}
	  				}
	  			}else if(val=="flower"){
	  				if(state==true){
	  					// 获取需要移除的key
	  					var keys = [];
	  					this.all.forEach(function(subItem, subIndex, array){
		  					if (subItem.value=='春' || subItem.value=="夏" || subItem.value=="秋" || subItem.value=="冬" || subItem.value=="梅" || subItem.value=="兰" || subItem.value=="竹" || subItem.value=="菊" ){
		  						keys.push(subIndex);
		  					};
	  					});

	  					// 移除排除的牌
	  					_this.all.splice(keys[0],8);

	  					//移除手牌
	  				 	for(var i=0;i<=4;i++){
							 for(var j=0;j<=this.pai[i].length-1;j++){
							 	var pai=this.pai[i][j].value;
							 	if(pai=='春' || pai=="夏" || pai=="秋" || pai=="冬" || pai=="梅" || pai=="兰" || pai=="竹" || pai=="菊")
							 	{
							 		_this.pai[i][j]={color:"#ccc",hover:false,value:-1};
							 	};
	  				 		};
	  				 	}  
	  				}else{
	  					//恢复花
	  					for(var i=34;i<=41;i++){
	  						_this.all.splice(i,0,{realValue: i, value: this.map(i), color: "#ccc", total: 1, hun: false, showHun: false});
	  					}	
	  				}
	  			}else{
	  				return;
	  			}
	  			
	  		},
	  		resetPai(player, index, item){
	  			let _this = this;
	  			this.all.forEach(function(subItem, subIndex, array){
	  				if (subItem.value == item.value) {
	  					_this.all[subIndex].total ++;
	  				}
	  			});
	  			this.pai[player][index].value = -1;
	  		},
	  		paiMouseenter(player, index, item){
	  			this.pai[player][index].hover = true;
	  		},
	  		paiMouseleave(player, index, item){
	  			this.pai[player][index].hover = false;
	  		},
	  		chonse(index, item){
	  			if (typeof(this.activePai.player)=="undefined" || typeof(this.pai[this.activePai.player][this.activePai.index])=="undefined" || !this.pai[this.activePai.player][this.activePai.index].hasOwnProperty('value')) {
	  				this.$message("请先选择一个牌！");
					return;
	  			}
	  			if (item.total <= 0) {
	  				this.$message("该牌已选完，请换一个！");
					return;
	  			}
	  			let _this = this;
	  			if (this.pai[this.activePai.player][this.activePai.index].value != -1) {
		  			// 如果选择的牌与当前牌相等，返回
		  			if (item.value == this.pai[this.activePai.player][this.activePai.index].value) {
		  				return;
		  			}
		  			this.all.forEach(function(item, index, array){
		  				if (item.value == _this.pai[_this.activePai.player][_this.activePai.index].value) {
		  					_this.all[index].total ++;
		  				}
		  			});
	  			}
	  			// 如果当前牌有值
	  			this.pai[this.activePai.player][this.activePai.index].value = item.value;
	  			this.all[index].total --;

	  			if (this.activePai.player != 1 && this.activePai.player != 2) {
		  			var paiNum = 12;
		  			// 选择完成之后 激活项向后挪一个
		  			if (this.zhuangSelected-1 == this.activePai.player) {
		  				paiNum = 13;
		  			}
				  	if (this.activePai.index >= paiNum) {
				  		// 下一个牌
						this.activePai.player++;
						if (this.activePai.player == 1 || this.activePai.player == 2) {
							if (this.zhuangSelected-1 == this.activePai.player) {
								this.activePai.index = 13;
							}else{
								this.activePai.index = 12;
							}
						}else{
							this.activePai.index = 0;
						}
					}else{
						this.activePai.index++;
					}
				}else{
		  			var paiNum = 0;
				  	if (this.activePai.index <= paiNum) {
				  		// 下一个牌
						this.activePai.player++;

						if (this.activePai.player != 1 && this.activePai.player != 2) {
							this.activePai.index = 0;
						}else{
							this.activePai.index = 12;
						}
					}else{
						this.activePai.index--;
					}
				}
	  		},
	  		// 导入
	  		imported(){
	    		var _this=this;
	    		var reader = new FileReader();
	    		if(this.file){
	            reader.readAsText(this.file, "UTF-8");
		            reader.onload = function(evt){ 
		                var fileString = evt.target.result; 
		      		 	var json = eval('('+fileString+')');
		      		 	_this.reset();
		      			if(json.hasOwnProperty("zhuangjia")){
							_this.zhuangSelected=json.zhuangjia;
							_this.zhuangChange(_this.zhuangSelected);
						}else{
			      			_this.tip = "文件格式错误";
							_this.$refs.modalTip.show();
							return;
	      				};
						if(json.hasOwnProperty("exclude")){
							for(var i=0;i<2;i++){
								var resgroup=json.exclude[i];
								if(resgroup.caption=="风" && resgroup.state==true){
									_this.buttons[0].state=true;
									_this.exclude("wind",true);
								}else if(resgroup.caption=="风" && resgroup.state==false){
									_this.buttons[0].state=false;
									//_this.exclude("wind",false);
								};
								if(resgroup.caption=="花" && resgroup.state==true){
									_this.buttons[1].state=true;
									_this.exclude("flower",true);
								}else if(resgroup.caption=="花" && resgroup.state==false){
									_this.buttons[1].state=false;
									//_this.exclude("flower",false);
								};
							};		
						}else{
			      			_this.tip = "文件格式错误";
							_this.$refs.modalTip.show();
	      				};
						if(json.hasOwnProperty("pais")){
							var pais = json.pais.split(',');
							var zhuang = _this.zhuangSelected-1;
							var k=0;
							// 填充玩家牌
							_this.pai.forEach(function(item, index, array){
								item.forEach(function(subItem, subIndex, subArray){								
									_this.pai[index][subIndex].value = _this.map(pais[k]);
									// 选择牌
									_this.all.forEach(function(ssItem, ssIndex, ssArray){
										if (ssItem.realValue == pais[k]) {
											_this.all[ssIndex].total--;
										}
									});
									k++;
								});
							});
							// 反转2,3
							_this.pai[1].reverse();
							_this.pai[2].reverse();
						}else{
			      			_this.tip = "文件格式错误";
							_this.$refs.modalTip.show();
	      				};
					};
	      		}else{
	      			this.tip = "请上传文件";
					this.$refs.modalTip.show();
	      		}
	    	},

	  		// 余下随机
	  		rand(){
	  			var _this = this;
	  			var paiTmp = _this.pai;
	  			var allTmp = _this.all;
	  			// 循环pai
	  			for(var i=0; i<=4; i++){
	  				_this.pai[i].forEach(function(item, index, array){
	  					if (item.value == -1) {
	  						var lastPai = [];
				  			// 整理all
				  			_this.all.forEach(function(subItem){
				  				if (subItem.total > 0) {
				  					lastPai.push(subItem);
				  				}
				  			});
				  			if (lastPai.length > 0) {
					  			// 从lastPai中随机选择一个
					  			var ind = Math.floor((Math.random()*(lastPai.length)));
					  			_this.all.forEach(function(subItem, subIndex){
					  				if (subItem.value == lastPai[ind].value) {
					  					_this.all[subIndex].total--;
					  				}
					  			});
					  			_this.pai[i][index].value = lastPai[ind].value;
				  			}
	  					}
	  				});
	  			}	
	  		},
	  		selectPlayerPai(player, index ,item){
	    		//this.activeId = good.id;
	    		this.activePai = {player: player, index: index}
	        },
	    	countDownChanged(dismissCountDown) {
	      		this.dismissCountDown = dismissCountDown;
	    	},
	    	showAlert() {
	      		this.dismissCountDown = this.dismissSecs;
	    	},
	    	zhuangChange(value){
	    		let _this = this;
	    		_this.pai.forEach(function(value1, index, array){
	    			if (value1.length == 14) {
	    				_this.all.forEach(function(subItem, subIndex, subArray){
	    					if (value1[value1.length-1].value == subItem.value) {
	    						_this.all[subIndex].total++;
	    					}
	    				});

	    				_this.pai[index].splice(value1.length-1, 1);
	    			}
	    		});
	    		this.pai[value-1].push({value: -1, color: '#ccc', hover: false});
	    	},
	    	allStyle(item){
	    		return "background-color:"+item.color;
	    	},
	    	map(value){
	    		if (value >=0 && value <=8) {
	    			var w = parseInt(value)+1;
	    			return w+'万';
	    		}else if (value >8 && value <=17) {
	    			return value-8+'条';
	    		}else if (value >17 && value <=26) {
	    			return value-17+'筒';
	    		}else if (value == 27) {
	    			return '东';
	    		}else if (value == 28) {
	    			return '南';
	    		}else if (value == 29) {
	    			return '西';
	    		}else if (value == 30) {
	    			return '北';
	    		}else if (value == 31) {
	    			return '中';
	    		}else if (value == 32) {
	    			return '发';
	    		}else if (value == 33) {
	    			return '白';
	    		}else if (value == 34) {
	    			return '春';
	    		}else if (value == 35) {
	    			return '夏';
	    		}else if (value == 36) {
	    			return '秋';
	    		}else if (value == 37) {
	    			return '冬';
	    		}else if (value == 38) {
	    			return '梅';
	    		}else if (value == 39) {
	    			return '兰';
	    		}else if (value == 40) {
	    			return '竹';
	    		}else if (value == 41) {
	    			return '菊';
	    		}
	    		return value;
	    	},
	    	reMap(string){
	    		for(var i=0;i<=this.all.length-1;i++){
	    			if (this.all[i].value == string) {
	    				return this.all[i].realValue;
	    			}
	    		}
	    		return -1;
	    	},
	    	generate(){
	    		var _this = this;
	    		var pais = [];
	    		this.pai.forEach(function(item, index, array){
	    			item.forEach(function(subItem, subIndex, subArray){
	/*    				if (subItem.value == -1) {
	    					_this.tip = "有牌是空值！";
	    					return;
	    				}*/
	    				if (index == 1 || index == 2) { // 反序
	    					pais.push(_this.reMap(subArray[subArray.length-1-subIndex].value));	
	    				}else{
	    				    pais.push(_this.reMap(subItem.value));	
	    				}
	    			})
	    		});
	    		//console.log(pais.length);
	    		var allPais = [];
	    		this.all.forEach(function(item, index, array){
	    			for(var j=0;j<item.total;j++){
	    				allPais.push(_this.reMap(item.value));
	    			}
	    		});
	    		// 打乱顺序
	    		allPais = allPais.sort(function() {
				     return (0.5-Math.random());
				})
	    		pais = pais.concat(allPais);
	    		//console.log(pais.length);
	    		var output = {
	    			pais: pais.join(','),
	    			zhuangjia: this.zhuangSelected,
	    			exclude: this.buttons
	    		};
	    		this.downloadFile('data.json', JSON.stringify(output));
	    	}
		},
		mounted() {
			for (var i=0;i<42;i++){
				var color = '#373e40';
				var total = 4;
				var showHun = true;
	    		if (i >=0 && i <=8) {
	    			color = '#a2b4ba';
	    		}else if (i >8 && i <=17) {
	    			color = '#373e40';
	    		}else if (i >17 && i <=26) {
	    			color = '#82abba';
	    		}else if (i > 26 && i <= 30) {
	    			color = '#00b0f0';	
	    		}else if (i > 30 && i <= 33) {
	    			color = '#00b38c';
	    		}else if (i > 33 && i <= 41) {
	    			showHun = false;
	    			color = '#ccc';	
	    			total = 1;
	    		}
				this.all.push({realValue: i, value: this.map(i), color: color, total: total, hun:false, showHun:showHun});
				this.activePai = {player: 0, index: 0};
			}
			let _this = this;
			this.getList();
		}
	}
</script>
<style>
	.el-dialog--small{
		width: 80%
	}
</style>
<style scoped lang="scss">
	@import '../styles/vars.scss';
	.permission-settings{
		width: 100%;  
	    background: #eef1f6;
	    position: absolute;
	    top: 10px;
	    z-index: 999;
	    .c-card{
	    	margin: 20px;
	    	.el-card__header{
	    		padding: 6px 20px;
	    	}
	    }
	    .clearfix:after{
	    	clear: both;
		    content: '';
		    display: block;
	    }
	}

	.clear{
		&:after{
			content:".";
			display:block;
			height:0;
			clear:both;	
		}
	}
	.m-20-0{
		margin: 20px 0px;
	}
	#content{
		min-width: 815px;
		.panel-header{
			position: relative;
		    border: solid #f7f7f9;
		    padding: 1.5rem;
		    border-width: .2rem;
		    background-color: #eee
		}
		.panel-content{

		}
		.top, .left, .right, .bottom, .all{
			text-align: center;
		}
		.bottom{
    		bottom: 0px;
		}
		.all{
			padding: 50px;
			.box{
				margin: 0.25rem !important;
				border-radius: 0.25rem !important;
				width: 80px;
    			height: 80px;
    			background-color: #ccc;
    			text-align: center;
    			display: inline-block;
    			position: relative;
    			padding: 30px 0px;
    			color: #fff;
    			cursor: pointer;
			}
		}
		.small-box{
			margin: 0.25rem !important;
			border-radius: 0.25rem !important;
			width: 50px;
			height: 50px;
			background-color: #ccc;
			text-align: center;
			display: inline-block;
			position: relative;
			background-color: #777;
			color: #fff;
			padding-top: 12px;
			cursor: pointer;
		}
		.small-box.active{
			background-color: #007bff
		}
			.imaged{
	z-indent:2;
    left:56px;
    top:59px;
    color:#fff ;  
    padding:10px; width:11px; height:12px;
    border: 1px solid #000000;
    opacity: 0.8;
    //-moz-border-radius: 15px; 
    //-webkit-border-radius: 15px; 
    //border-radius:50%;
    position:absolute;
	}
	}

</style>