function init(Vue) {

    //获得某周的开始日期　　 
    //Vue.prototype.fs = fs;
    Vue.prototype.downloadFile = function(filename, content){
        var eleLink = document.createElement('a');
        eleLink.download = filename;
        eleLink.style.display = 'none';
        // 字符内容转变成blob地址
        var blob = new Blob([content]);
        eleLink.href = URL.createObjectURL(blob);
        // 触发点击
        document.body.appendChild(eleLink);
        eleLink.click();
        // 然后移除
        document.body.removeChild(eleLink);
    } 

    Vue.prototype.initPais = [
                [{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}],
                [{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
                [{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
                [{value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false},{value:-1, color: '#ccc', hover: false}, {value:-1, color: '#ccc', hover: false}],
            ];
}
export { init };