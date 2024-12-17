@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-12">
                <!-- Page title -->
                <!-- Viewings list START -->
                <div class="row">
                    <div class="col-md-12">


                        <!-- Viewings -->
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Listing
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Requested By
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Visit Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Time
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewings as $viewing)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                                {{ $viewing->listing->title }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $viewing->requestedBy->fname }} {{ $viewing->requestedBy->mname }}
                                                {{ $viewing->requestedBy->lname }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($viewing->viewing_date)->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($viewing->viewing_time)->format('h:i A') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div
                                                    class="badge 
                                                @if ($viewing->viewing_status == 'approved') bg-success 
                                                @elseif($viewing->viewing_status == 'declined') bg-danger 
                                                @elseif($viewing->viewing_status == 'cancelled') bg-warning 
                                                @else bg-secondary @endif">
                                                    {{ ucfirst($viewing->viewing_status) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{-- <a class="btn btn-sm btn-info-soft me-1 mb-1" href="{{ route('viewings.show', $viewing->id) }}"><i class="fas fa-fw fa-eye"></i></a> --}}
                                                <form action="{{ route('booking.accept', $viewing->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success-soft me-1 mb-1"
                                                        type="submit">Accept</button>
                                                </form>
                                                <form action="{{ route('booking.decline', $viewing->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger-soft mb-1"
                                                        type="submit">Decline</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($viewings->isEmpty())
                            <p class="text-center">You have no viewings at this time.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Viewings list END -->
        </div>
    </div> <!-- Row END -->
    </div>
@endsection
