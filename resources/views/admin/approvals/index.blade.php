@extends('layouts.app')

@section('content')
<div class="main-content">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Pending Owner Approvals</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Business</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pendingApprovals as $approval)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $approval->user->fname }} {{ $approval->user->lname }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $approval->business_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $approval->user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $approval->business_phone }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-2">
                                <form action="{{ route('admin.approvals.approve', $approval->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                </form>
                                <form action="{{ route('admin.approvals.reject', $approval->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No pending approvals
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($pendingApprovals->hasPages())
            <div class="px-6 py-4">
                {{ $pendingApprovals->links() }}
            </div>
        @endif
    </div>
</div>
</div>
@endsection
