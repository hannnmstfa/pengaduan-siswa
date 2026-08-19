@extends('layouts.admin')

@section('title')
  Dashboard
@endsection

@section('content')
  <main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
      </h2>

            <div>
              <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Selesai
              </p>
              <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                {{ $tanggapan }}
              </p>
            </div>
          </div>
        </div>
      @endif
    </div>
  </main>
@endsection