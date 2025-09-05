@extends('admin.layouts.app')
@section('admin/content')
<div class="page-wrapper">
  <div class="page-content">
  <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

    <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
      <div class="mb-0 text-uppercase">
        <h6>Plan List</h6>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
      @foreach ($plans as $plan)
        @php
          if (in_array($plan->id, $userPlans)) {
              $colorClass = 'bg-info text-white';
              $statusText = 'Activated';
              $clickable = false;
          } elseif ($plan->id == $nextPlanId) {
              $colorClass = 'bg-warning text-dark';
              $statusText = 'Next to activate';
              $clickable = true;
          } else {
              $colorClass = 'bg-gray text-white';
              $statusText = 'Remaining plan';
              $clickable = false;
          }
        @endphp

          <a href="javascript:void(0);"
           @if($clickable)
             class="activate-plan"
             data-planid="{{ $plan->id }}"
             data-amount="{{ $plan->plan_amount }}"
             data-userid="{{ auth()->user()->id }}"
             data-upgradeamount="{{ auth()->user()->upgrade }}"
           @endif>
          <div class="col">
            <div class="card radius-10 {{ $colorClass }}">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div>
                    <p class="mb-0">{{ $plan->plan_name }}</p>
                    <h4 class="my-1">{{ $plan->plan_amount }} $</h4>
                    <p class="mb-0 font-13">{{ $statusText }}</p>
                  </div>
                  <div class="widgets-icons bg-light-transparent ms-auto">
                    <i class="bx bxs-trophy"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Trust Wallet Launch Helper --}}
<script>
  const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
  const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);
  const isAndroid = /Android/.test(navigator.userAgent);

  function openInTrustWallet(targetUrl) {
    const fullUrl = targetUrl.startsWith('http')
      ? targetUrl
      : (window.location.origin.replace(/\/$/, '') + '/' + targetUrl.replace(/^\//, ''));

    if (isMobile) {
      if (isIOS) {
        // Universal link first
        window.location.href = `https://link.trustwallet.com/open_url?coin_id=60&url=${encodeURIComponent(fullUrl)}`;
        // Fallback app scheme
        setTimeout(() => {
          window.location.href = `trust://open_url?coin_id=60&url=${encodeURIComponent(fullUrl)}`;
        }, 800);
      } else if (isAndroid) {
        // Android intent
        const intent = `intent://open_url?coin_id=60&url=${encodeURIComponent(fullUrl)}#Intent;scheme=trust;package=com.wallet.crypto.trustapp;end`;
        window.location.href = intent;
        // Fallback universal link
        setTimeout(() => {
          window.location.href = `https://link.trustwallet.com/open_url?coin_id=60&url=${encodeURIComponent(fullUrl)}`;
        }, 800);
      } else {
        window.location.href = `https://link.trustwallet.com/open_url?coin_id=60&url=${encodeURIComponent(fullUrl)}`;
      }

      // Helper message if still on page
      setTimeout(() => {
        if (!document.hidden) {
          alert("If Trust Wallet didn't open:\n1) Open Trust Wallet app\n2) Browser tab\n3) Paste this URL:\n" + fullUrl);
        }
      }, 2500);
    } else {
      // Desktop → just navigate (extension or WalletConnect handled on the next page)
      window.location.href = fullUrl;
    }
  }

  document.addEventListener("click", function(e) {
    const link = e.target.closest(".activate-plan");
    if (!link) return;
    e.preventDefault();

    const planid = link.dataset.planid;
    const userid = link.dataset.userid;

    // Visual loading tag
    link.style.opacity = '0.7';
    link.style.pointerEvents = 'none';
    const tag = document.createElement('div');
    tag.textContent = 'Opening Trust Wallet...';
    Object.assign(tag.style, {
      position: 'absolute', top: '10px', right: '10px',
      background: 'rgba(0,0,0,0.7)', color: '#fff',
      padding: '2px 6px', borderRadius: '4px', fontSize: '10px'
    });
    link.style.position = 'relative';
    link.appendChild(tag);

    // Route to the dedicated payment page
    const target = `{{ url('admin/plan_payment') }}/${encodeURIComponent(planid)}/${encodeURIComponent(userid)}`;
    openInTrustWallet(target);

    setTimeout(() => {
      link.style.opacity = '1';
      link.style.pointerEvents = 'auto';
      tag.remove();
    }, 3000);
  });
</script>
@endsection
