<div class="p-6 bg-slate-900 border border-slate-800 rounded-2xl text-slate-100 mt-8 shadow-xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 pb-4 border-b border-slate-800">
        <div>
            <h2 class="text-xl font-black text-purple-400">⭐ Customer Reviews & Ratings</h2>
            <p class="text-xs text-slate-400 mt-1">Average Rating: <span class="font-bold text-amber-400 font-mono text-sm">{{ $avgRating }} / 5</span> ({{ $reviews->count() }} reviews)</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-purple-950/80 border border-purple-500/50 text-purple-200 rounded-xl text-xs font-semibold">
            ✨ {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-3 bg-red-950/80 border border-red-500/50 text-red-200 rounded-xl text-xs font-semibold">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    @auth
        <form wire:submit.prevent="submitReview" class="mb-8 p-4 bg-slate-950 border border-slate-800 rounded-xl space-y-4">
            <h3 class="text-xs font-bold uppercase font-mono text-slate-300">Write a Review</h3>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Rating (1 to 5 Stars)</label>
                <div class="flex gap-2">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="$set('rating', {{ $i }})" class="text-xl transition focus:outline-none">
                            <span class="{{ $i <= $rating ? 'text-amber-400' : 'text-slate-700' }}">★</span>
                        </button>
                    @endfor
                </div>
            </div>

            <div>
                <textarea wire:model="comment" rows="3" placeholder="Share your experience with this product..." class="w-full bg-slate-900 border border-slate-800 rounded-xl p-3 text-xs text-slate-200 focus:border-purple-500 outline-none transition"></textarea>
                @error('comment') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="px-5 py-2 bg-purple-600 hover:bg-purple-500 text-white font-bold text-xs rounded-xl transition shadow-lg shadow-purple-600/30">
                Submit Review
            </button>
        </form>
    @else
        <div class="mb-8 p-4 bg-slate-950 border border-slate-800 rounded-xl text-xs text-slate-400 text-center">
            🔒 Please <a href="{{ route('login') }}" class="text-purple-400 underline font-bold">log in</a> to leave a review.
        </div>
    @endauth

    <div class="space-y-4">
        @forelse($reviews as $review)
            <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-xl space-y-2">
                <div class="flex justify-between items-center">
                    <div class="font-bold text-xs text-slate-200">
                        {{ $review->user->name ?? 'Anonymous Customer' }}
                    </div>
                    <div class="text-amber-400 font-mono text-xs">
                        @for($i = 1; $i <= 5; $i++)
                            <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                        @endfor
                    </div>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed">{{ $review->comment }}</p>
                <div class="text-[10px] text-slate-500 font-mono">
                    Reviewed on {{ $review->created_at->format('M d, Y') }}
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-xs text-slate-500 font-mono">
                No reviews yet. Be the first to review this product!
            </div>
        @endforelse
    </div>
</div>