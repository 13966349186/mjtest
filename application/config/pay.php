<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['aliPay'] = array (	
		//应用ID,您的APPID。
		'app_id' => "2016082000294924",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEA73DSPnSnYU/tZXG/SCwoxpwTvrk/NzDYJmIEMROVup4ndSTojOXRi/QkW241VYY4Wi92Nmuf453fHnV2WCKDPcuLjbhxljD2+ogpCKrBgYo3DDlJmOuyLHTWcCv3foCs73nZXqhG5VWHLLl3sziqv5e1uObFMEGDmsx6BF6sZBQo18ZL7karS1wSLGfn/CmBHNck1umdSRLjOS3FEfmUGi5g4Ja14EBG029U91yDoxiPWTpIDfgvJHMYpid+9jy0Vs05wKSXBbhch4QsKWs2Q9LO7qWMhCTMUuLEYsbk+nFTqA0OvZ6XR9VdpRb4y3YG++578FceuKyjESglNlx/sQIDAQABAoIBAHLwkbxxezf3ilo8NDqNGDXfDotrmbEAvYIPYzu7zxB6gy50vT2FxQWN+TX6vZeEiuCgD/snxuUZD9YrRNgiGSY844zwkXYroyO44RnL/oAUvUAc7/t8iVdV7uqB8JjFZD7BG1uZJA9K80zA63kZJr46MX3FKbt0d5yDs78NQ2v2Y6TMVPAHVJcYZMI/EKPVPUfmcw0f9ktOxPJBblrobl9PZ0fXWnPdxIUTZf7GMvYexh4FYmK5aUkYwadiildFc7FAqT8dI5M7Po1kVuet+J2b0AH0D1jxBt43LdCNiZGJpFbwdP2Q4dNOk17oUF14IyT+rQyB/opbGG1mVXFyFBECgYEA/1jLk2i3O0H3pBmDt/gl/Px2BnGZ5/F6F4rkSDi1XVAl8LB3mdxsU/bdNu3sbwABBZcoaowO5TDWBO8fN8vW5Axz60ZP9FF1C/Lbd8aJMySuR6rI7yx2te32ED7FOgIeCF8qXgm5GFZp3+PfhZrQKqwcEPqQW+w5v2u6OI0VLMcCgYEA8A2cR/73hnGCaLbX7PDLXAyPHo/cfRpc73oGsQ4SPY/BXLJ1vKbl4VOzppA5BpK885oSH1I6byKQyJcRP18hE/iMtszS1vmq55JTEKnM805eQfQM6DrvnFc0aNLmJX40+bYlnLN1RVyiSEv6CRCdheJgYY9aBYWTYiDucDoox8cCgYEAwcRcF2xrPyh8B6bk8YH5MdVSqukh5YS1JZBcUwHVfw4G/HKtD7DY845tp/U8aa8TF27xWIkX9IvunKfohKrGUx+wB2W/3qLBs2ODb4zVKF45cmEDQZv4KW5+Py2i9LYOnEO7Hsk6EGHizedaA0TLmtYoJio9ycOkvsG8+pT08JkCgYAb4MjEh7TBVU9az9k1uCU11HOOjhCCKtyeJyK9zy+JHLfNByCrPwq1Z14WuusUe1gcRklSf98vZuk/kmO7Y1XZFuVomVLnCmmxqQmihsW5f+FscWZKVgXbtzjr74ow0n5efavSjfjRjFeAY+puwRI6KTcePWKr/35FSCPIvshbowKBgH13Ixjw3Tq5n3I1oeDcWaXbMguXNmtGM+GfN7T2XnSWlXEJyZXS+FGkec0Co8a1FLPm9l5iSNsiS/G0qsSq7xwzZn/m7SxFRf4p4DmjNpyt6VNFywh8lqF1mTYB9pyQil4FgeN0Iaf+HrbgtxPHS7eA4qT5seY9RpgfSRqyTX3E",
		
		//异步通知地址
		'notify_url' => "http://3a0f7cd0.ngrok.io/agent/auth/alipayNotify",
		
		//同步跳转
		'return_url' => "http://3a0f7cd0.ngrok.io/agent/index.html#paySuccess",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关 // 改成沙箱环境的
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAm4R6I3vpjUnbTyyiI4MYjKIgmt5lY+uWLj/WyNrhSnKJ+ZlgdHxFWp0O9RoMgfwWqPnsNM17ERgOfufTc2zy1sjGu7V96qISCRHu/8BT6S8wmZHktQdJwtE6IFj3ufuUu0qCUGm/nbqdnDyGlta9zbX3WDjUReZahYFPcQufaJiGKAjBgE+24sYt4VUyI3rctUSWTp81gpFizSHhWWUyhN2rBbhohi3LvVQCrB/wpJH9HQB2R7pyj/WCuXYjhvq1jdWkCbNueUKymI7Xk57sUIc6La+WNteHKocGjrjEdCdU8wJ4IQC2pjus00XJdAanVBmgd8DoNDeIirIZ2+zDvQIDAQAB",
);

/*$config['aliPay'] = array (	
		//应用ID,您的APPID。
		'app_id' => "201708090811119",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEA73DSPnSnYU/tZXG/SCwoxpwTvrk/NzDYJmIEMROVup4ndSTojOXRi/QkW241VYY4Wi92Nmuf453fHnV2WCKDPcuLjbhxljD2+ogpCKrBgYo3DDlJmOuyLHTWcCv3foCs73nZXqhG5VWHLLl3sziqv5e1uObFMEGDmsx6BF6sZBQo18ZL7karS1wSLGfn/CmBHNck1umdSRLjOS3FEfmUGi5g4Ja14EBG029U91yDoxiPWTpIDfgvJHMYpid+9jy0Vs05wKSXBbhch4QsKWs2Q9LO7qWMhCTMUuLEYsbk+nFTqA0OvZ6XR9VdpRb4y3YG++578FceuKyjESglNlx/sQIDAQABAoIBAHLwkbxxezf3ilo8NDqNGDXfDotrmbEAvYIPYzu7zxB6gy50vT2FxQWN+TX6vZeEiuCgD/snxuUZD9YrRNgiGSY844zwkXYroyO44RnL/oAUvUAc7/t8iVdV7uqB8JjFZD7BG1uZJA9K80zA63kZJr46MX3FKbt0d5yDs78NQ2v2Y6TMVPAHVJcYZMI/EKPVPUfmcw0f9ktOxPJBblrobl9PZ0fXWnPdxIUTZf7GMvYexh4FYmK5aUkYwadiildFc7FAqT8dI5M7Po1kVuet+J2b0AH0D1jxBt43LdCNiZGJpFbwdP2Q4dNOk17oUF14IyT+rQyB/opbGG1mVXFyFBECgYEA/1jLk2i3O0H3pBmDt/gl/Px2BnGZ5/F6F4rkSDi1XVAl8LB3mdxsU/bdNu3sbwABBZcoaowO5TDWBO8fN8vW5Axz60ZP9FF1C/Lbd8aJMySuR6rI7yx2te32ED7FOgIeCF8qXgm5GFZp3+PfhZrQKqwcEPqQW+w5v2u6OI0VLMcCgYEA8A2cR/73hnGCaLbX7PDLXAyPHo/cfRpc73oGsQ4SPY/BXLJ1vKbl4VOzppA5BpK885oSH1I6byKQyJcRP18hE/iMtszS1vmq55JTEKnM805eQfQM6DrvnFc0aNLmJX40+bYlnLN1RVyiSEv6CRCdheJgYY9aBYWTYiDucDoox8cCgYEAwcRcF2xrPyh8B6bk8YH5MdVSqukh5YS1JZBcUwHVfw4G/HKtD7DY845tp/U8aa8TF27xWIkX9IvunKfohKrGUx+wB2W/3qLBs2ODb4zVKF45cmEDQZv4KW5+Py2i9LYOnEO7Hsk6EGHizedaA0TLmtYoJio9ycOkvsG8+pT08JkCgYAb4MjEh7TBVU9az9k1uCU11HOOjhCCKtyeJyK9zy+JHLfNByCrPwq1Z14WuusUe1gcRklSf98vZuk/kmO7Y1XZFuVomVLnCmmxqQmihsW5f+FscWZKVgXbtzjr74ow0n5efavSjfjRjFeAY+puwRI6KTcePWKr/35FSCPIvshbowKBgH13Ixjw3Tq5n3I1oeDcWaXbMguXNmtGM+GfN7T2XnSWlXEJyZXS+FGkec0Co8a1FLPm9l5iSNsiS/G0qsSq7xwzZn/m7SxFRf4p4DmjNpyt6VNFywh8lqF1mTYB9pyQil4FgeN0Iaf+HrbgtxPHS7eA4qT5seY9RpgfSRqyTX3E",
		
		//异步通知地址
		'notify_url' => "http://c128377a.ngrok.io/agent/auth/alipayNotify",
		
		//同步跳转
		'return_url' => "http://c128377a.ngrok.io/agent/index.html#paySuccess",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关 // 改成沙箱环境的
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAm4R6I3vpjUnbTyyiI4MYjKIgmt5lY+uWLj/WyNrhSnKJ+ZlgdHxFWp0O9RoMgfwWqPnsNM17ERgOfufTc2zy1sjGu7V96qISCRHu/8BT6S8wmZHktQdJwtE6IFj3ufuUu0qCUGm/nbqdnDyGlta9zbX3WDjUReZahYFPcQufaJiGKAjBgE+24sYt4VUyI3rctUSWTp81gpFizSHhWWUyhN2rBbhohi3LvVQCrB/wpJH9HQB2R7pyj/WCuXYjhvq1jdWkCbNueUKymI7Xk57sUIc6La+WNteHKocGjrjEdCdU8wJ4IQC2pjus00XJdAanVBmgd8DoNDeIirIZ2+zDvQIDAQAB",
);*/
