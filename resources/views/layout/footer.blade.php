                </div>
                    </div>
                        <div id="kt_app_footer" class="app-footer d-flex flex-column flex-md-row flex-center flex-md-stack pb-7">
							<div class="text-gray-900 order-2 order-md-1">
								<span class="text-muted fw-semibold me-1">{{ date('Y') }}&copy;</span>
								<a href="{{ url('/') }}" target="_blank"
									class="text-gray-800 text-hover-primary">{{ env('APP_NAME') }}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<i class="ki-outline ki-arrow-up"></i>
	</div>

	<script>
        var base, BASE_URL, hostUrl = "{{ url('/') }}";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}"></script>
	<!--end::Vendors Javascript-->
	@stack('scripts')
</body>
</html>
