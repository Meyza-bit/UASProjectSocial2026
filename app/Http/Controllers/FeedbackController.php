Feedback::create([...])                          // store()
Feedback::with('user', 'program')->latest()->get() // index()
Feedback::ratingTinggi()->get()                  // terbaik()
Feedback::avg('rating')                          // rata-rata