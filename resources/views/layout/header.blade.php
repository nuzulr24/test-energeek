<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<title>myTODO</title>

    <!-- SEO Meta Tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--seo meta-->
    <link rel="canonical" href="{{ url('/') }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:updated_time" content="{{ date('Y-m-d H:i:s') }}" />
    <meta property="fb:app_id" content="1046871135361991" />
    <meta property="og:image:width" content="324" />
    <meta property="og:image:height" content="324" />
    <meta property="og:image:alt" content="hosting murah" />
    <meta property="og:image:type" content="image/png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:label1" content="Written by" />
    <meta name="twitter:data1" content="postamu" />
    <meta name="twitter:label2" content="Time to read" />
    <meta name="twitter:data2" content="7 minutes" />

	<link rel="canonical" href="{{ url('/') }}" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
	<style>
		body {
    		--primary-color: 13, 45, 123;
    		--icon-size: 3rem;
		}
	</style>
	@stack('css')
	<script>
		// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
		if (window.top != window.self) {
			window.top.location.replace(window.self.location.href);
		}
	</script>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<!--begin::Page-->
		<div class="app-page  flex-column flex-column-fluid " id="kt_app_page">


			<!--begin::Header-->
			<div id="kt_app_header" class="app-header " data-kt-sticky="true"
				data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky"
				data-kt-sticky-offset="{default: false, lg: '300px'}">

				<!--begin::Header container-->
				<div class="app-container  container-xxl d-flex align-items-stretch justify-content-between "
					id="kt_app_header_container">
					<!--begin::Header mobile toggle-->
					<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
						<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
							<i class="ki-outline ki-abstract-14 fs-2"></i> </div>
					</div>
					<!--end::Header mobile toggle-->

					<!--begin::Logo-->
					<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-1 me-lg-13">
						<a href="{{ url('/') }}">
							<span class="fs-2 text-dark fw-bolder">myTODO</span>
						</a>
					</div>
					<!--end::Logo-->

					<!--begin::Header wrapper-->
					<div class="d-flex align-items-center justify-content-end flex-lg-grow-1"
						id="kt_app_header_wrapper">

						<!--begin::Menu wrapper-->
						<div class="d-flex align-items-center" id="kt_app_header_menu_wrapper">
							<!--begin::Menu holder-->
							<div class="app-header-menu app-header-mobile-drawer align-items-stretch"
								data-kt-drawer="true" data-kt-drawer-name="app-header-menu"
								data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
								data-kt-drawer-width="{default:'200px', '300px': '250px'}"
								data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle"
								data-kt-swapper="true" data-kt-swapper-mode="prepend"
								data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}">
								<!--begin::Menu-->
								<div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-600 menu-state-gray-900 menu-arrow-gray-500 fw-semibold fw-semibold fs-6 align-items-stretch my-5 my-lg-0 px-2 px-lg-0"
									id="#kt_app_header_menu" data-kt-menu="true">
									<!--begin:Menu item-->
									<a href="{{ route('index') }}" class="menu-item me-0 me-lg-2">
										<span class="menu-link"><span class="menu-icon">
											<i class="ki-duotone ki-home-1">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span><span
										class="menu-title">Beranda</span><span
										class="menu-arrow d-lg-none"></span></span>
									</a>
                                    <a href="{{ route('list') }}" class="menu-item me-0 me-lg-2">
										<span class="menu-link"><span class="menu-icon">
											<i class="ki-duotone ki-questionnaire-tablet">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</span><span
										class="menu-title">Tugas</span><span
										class="menu-arrow d-lg-none"></span></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Wrapper-->
			<div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
				<div id="kt_app_toolbar" class="app-toolbar  pt-4 pt-lg-7 mb-n2 mb-lg-n3 ">

					<!--begin::Toolbar container-->
					<div id="kt_app_toolbar_container"
						class="app-container  container-xxl d-flex flex-stack flex-row-fluid ">
						<!--begin::Toolbar container-->
						<div class="d-flex flex-stack flex-row-fluid">
							<!--begin::Toolbar container-->
							<div class="d-flex flex-column flex-row-fluid">
								<!--begin::Toolbar wrapper-->

								<!--begin::Breadcrumb-->
								<ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-1 mb-lg-3 me-2 fs-7">

									<!--begin::Item-->
									<li class="breadcrumb-item text-gray-700 fw-bold lh-1">
										<a href="{{ url('/') }}" class="text-white text-hover-primary">
											<i class="ki-outline ki-home text-gray-700 fs-6"></i> </a>
									</li>
									<!--end::Item-->

									<!--begin::Item-->
									<li class="breadcrumb-item">
										<i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i> </li>
									<!--end::Item-->


									<!--begin::Item-->
									<li class="breadcrumb-item text-gray-700 fw-bold lh-1">
										Halaman Utama </li>
								</ul>

								<div class="page-title d-flex align-items-center me-3">
									<h1
										class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0 mt-2">
										@yield('title')
									</h1>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="app-container  container-xxl d-flex ">
					<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
					    <div class="d-flex flex-column flex-column-fluid">
							<div id="kt_app_content" class="app-content">
