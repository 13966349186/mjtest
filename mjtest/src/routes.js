import Global from './components/Global.vue'
//import Home from './components/Home.vue'
import MjTest from './components/MjTest.vue'
let routes = [
    {
        path: '/',
        component: Global,
        name: '麻将',
        hidden: false,
        children: [
            {
                // 我的信息
                path: '/MjTest',
                component: MjTest,
                name: '麻将测试',
                hidden: false
            } 
        ]
    }
];
export default routes;