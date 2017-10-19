import axios from 'axios';
import qs from 'qs';

//let base = '/admin';

// 拦截request,设置全局请求为ajax请求
//axios.interceptors.request.use((config) => {
//  config.headers['X-Requested-With'] = 'XMLHttpRequest'
//  return config
//})

//活动任务
export const getM = params => { 
	return axios({
	  url: '/admin/mjTest/get',
	  params: params,
	  method: 'get'
	})
};

export const deleteM = params => { 
	return axios({
	  url: '/admin/mjTest/delete',
	  method: 'delete',
	  data: qs.stringify(params)
	})
};

export const editM = params => { 
	return axios({
	  url: '/admin/mjTest/edit',
	  method: 'put',
	  data: qs.stringify(params)
	})
};

export const addM = params => { 
	return axios({
	  url: '/admin/mjTest/add',
	  method: 'post',
	  data: qs.stringify(params)
	})
};