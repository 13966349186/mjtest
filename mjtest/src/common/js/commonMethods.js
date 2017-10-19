import axios from 'axios';
import { Message } from 'element-ui';
function init(Vue) { 

    // 获取价格类型
    Vue.prototype.getPriceTypes = function() {　
        let ret = []
        this.$http.get('./resources/json/price_type_config.json').then(function(res){
             res.body.forEach(function(item, index, array){
                ret.push({
                    label: item.Icon,
                    value: item.Id,
                    Name: item.Name
                });
             });
        }); 
        return ret; 　　　　  
    }
    　
    ////////////////////////////////////////////////////////////////////////////////////////////
    // 拦截响应response，并做一些错误处理
    ////////////////////////////////////////////////////////////////////////////////////////////
    axios.interceptors.response.use((response) => {
        console.log(response);
        let oprate = '';
        switch(response.config.method){
            case 'delete':
                oprate = '删除';
            break;
            case 'post':
                if (response.config.url == '/admin/logout') {
                    oprate = '登出';
                }else if (response.config.url == '/admin/login') {
                    oprate = '登陆';
                }else{
                    oprate = '添加';
                }
            break;
            case 'get':
                return response;
            break;
            case 'put':
                oprate = '更新';
            break;            
        }

        // 信息提示
        Message({
            message: oprate+'成功',
            type: 'success'
        });

        return response;
    }, (err) => { // 这里是返回状态码不为200时候的错误处理
        if (err.response.status == 401 || err.response.data.code == 1001) {
            // 跳转到登陆页面 没有权限或者登陆会话失效
            window.location.href = "/admin/index.html#/login";
        }
        let errMessage = '';
        if (err.response.data == '') {
            errMessage = err.response.statusText;
        }else{
            errMessage = err.response.data.message;
        }
        Message({
            message: errMessage,
            type: 'error'
        });
        return Promise.reject(err)
    })
    Vue.prototype.$axios = axios
}
export { init };