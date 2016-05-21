angular
	.module('shakebot', [
		'ui.router'
	])
	.config(['$urlRouterProvider', '$stateProvider', function($urlRouterProvider, $stateProvider){
		
		
		$stateProvider
			.state('home', {
				url: '/',
				templateUrl: 'lib/pages/home.php'
			})
			.state('profile', {
				url: '/profile',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('contact', {
				url: '/contact',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('how-shakebot-works', {
				url: '/how-shakebot-works',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('what-makes-shakebot-unique', {
				url: '/what-makes-shakebot-unique',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('userProfile', {
				url: '/profile/start',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('about', {
				url: '/about',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('research', {
				url: '/research',
				templateUrl: 'lib/pages/research.php'
			})
			.state('sign-in', {
				url: '/sign-in',
				templateUrl: 'lib/pages/login.php'
			})
			.state('settings', {
				url: '/profile/settings',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('profile/nutrition', {
				url: '/profile/nutrition',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('checkout', {
				url: '/checkout',
				templateUrl: 'lib/pages/checkout.php'
			})
			.state('history', {
				url: '/profile/history',
				templateUrl: 'lib/pages/profile.php'
			})
			.state('products', {
				url: '/products',
				templateUrl: 'lib/pages/products.php'
			})
	}])
