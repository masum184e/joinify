@extends('dashboard.includes.layout')

@section('title', 'Dashboard')
@section('sub-title', 'Secretary')

@section('layout-title', 'Club Secretary')
@section('layout-sub-title', 'Manage your club, track events, and oversee member activities.')

@section('content')

    <div class="mb-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-card rounded-lg border border-border p-4 shadow-sm">
                <div class="flex items-center justify-between pb-2">
                    <h3 class="text-sm font-medium">Total Events</h3>
                    <i class="ri-calendar-line text-muted-foreground"></i>
                </div>
                <div class="text-2xl font-bold">{{ $totalEvents }}</div>
                <div class="text-xs text-muted-foreground">All time</div>
            </div>

            <div class="bg-card rounded-lg border border-border p-4 shadow-sm">
                <div class="flex items-center justify-between pb-2">
                    <h3 class="text-sm font-medium">Upcoming Events</h3>
                    <i class="ri-time-line text-muted-foreground"></i>
                </div>
                <div class="text-2xl font-bold">{{ $upcomingEvents }}</div>
                <div class="text-xs text-muted-foreground">Next 30 days</div>
            </div>

            <div class="bg-card rounded-lg border border-border p-4 shadow-sm">
                <div class="flex items-center justify-between pb-2">
                    <h3 class="text-sm font-medium">Total Guests</h3>
                    <i class="ri-user-line text-muted-foreground"></i>
                </div>
                <div class="text-2xl font-bold">{{ $totalGuests }}</div>
                <div class="text-xs text-muted-foreground">Event attendees</div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-card rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <div class="flex items-center">
                        <i class="ri-calendar-line mr-2 h-4 w-4"></i>
                        <h3 class="font-medium">Upcoming Events</h3>
                    </div>
                    <p class="text-sm text-muted-foreground">Events scheduled in the next 30 days</p>
                </div>
                <div class="p-4">
                    <div class="space-y-6">
                        <div class="border-b pb-4 last:border-0">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium">Tech Conference</h3>
                            </div>
                            <div class="flex items-center text-sm text-muted-foreground mb-1">
                                <i class="ri-time-line mr-2 h-4 w-4"></i>
                                May 15, 2023 • 2:00 PM
                            </div>
                            <div class="flex items-center text-sm text-muted-foreground">
                                <i class="ri-map-pin-line mr-2 h-4 w-4"></i>
                                Main Auditorium
                            </div>
                        </div>

                        <div class="border-b pb-4 last:border-0">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium">Photography Exhibition</h3>
                            </div>
                            <div class="flex items-center text-sm text-muted-foreground mb-1">
                                <i class="ri-time-line mr-2 h-4 w-4"></i>
                                May 20, 2023 • 10:00 AM
                            </div>
                            <div class="flex items-center text-sm text-muted-foreground">
                                <i class="ri-map-pin-line mr-2 h-4 w-4"></i>
                                Art Gallery
                            </div>
                        </div>

                        <div class="border-b pb-4 last:border-0">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium">Debate Competition</h3>
                            </div>
                            <div class="flex items-center text-sm text-muted-foreground mb-1">
                                <i class="ri-time-line mr-2 h-4 w-4"></i>
                                May 25, 2023 • 3:00 PM
                            </div>
                            <div class="flex items-center text-sm text-muted-foreground">
                                <i class="ri-map-pin-line mr-2 h-4 w-4"></i>
                                Conference Room B
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Events -->
            <div class="bg-card rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <div class="flex items-center">
                        <i class="ri-calendar-line mr-2 h-4 w-4"></i>
                        <h3 class="font-medium">Recent Events</h3>
                    </div>
                    <p class="text-sm text-muted-foreground">Past events and attendance records</p>
                </div>
                <div class="p-4">
                    <div class="space-y-6">
                        @foreach ($recentEvents as $event)
                            <div class="border-b pb-4 last:border-0">
                                <a href="/dashboard/{{ $clubId }}/events/{{ $event->id }}">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-medium">{{ $event->title }}</h3>
                                    </div>
                                    <div class="flex items-center text-sm text-muted-foreground mb-1">
                                        <i class="ri-calendar-line mr-2 h-4 w-4"></i>
                                        {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                                    </div>
                                    <div class="flex items-center text-sm text-muted-foreground">
                                        <i class="ri-user-line mr-2 h-4 w-4"></i>
                                        {{ $event->guests->count() }} guests
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <!-- Event Calendar and Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-card rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <div class="flex items-center justify-between">
                        <h3 class="font-medium">Event Calendar</h3>
                        <div class="flex gap-2">
                            <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0">
                                <i class="ri-arrow-left-s-line"></i>
                            </button>
                            <span class="text-sm">May 2023</span>
                            <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0">
                                <i class="ri-arrow-right-s-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-7 gap-1 text-center text-xs font-medium text-muted-foreground mb-2">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-sm">
                        <div class="aspect-square p-1 text-muted-foreground">30</div>
                        <div class="aspect-square p-1">1</div>
                        <div class="aspect-square p-1">2</div>
                        <div class="aspect-square p-1">3</div>
                        <div class="aspect-square p-1">4</div>
                        <div class="aspect-square p-1">5</div>
                        <div class="aspect-square p-1">6</div>
                        <div class="aspect-square p-1">7</div>
                        <div class="aspect-square p-1">8</div>
                        <div class="aspect-square p-1">9</div>
                        <div class="aspect-square p-1">10</div>
                        <div class="aspect-square p-1">11</div>
                        <div class="aspect-square p-1">12</div>
                        <div class="aspect-square p-1">13</div>
                        <div class="aspect-square p-1">14</div>
                        <div class="aspect-square p-1 bg-primary/10 rounded-md font-medium text-primary">15</div>
                        <div class="aspect-square p-1">16</div>
                        <div class="aspect-square p-1">17</div>
                        <div class="aspect-square p-1">18</div>
                        <div class="aspect-square p-1">19</div>
                        <div class="aspect-square p-1 bg-primary/10 rounded-md font-medium text-primary">20</div>
                        <div class="aspect-square p-1">21</div>
                        <div class="aspect-square p-1">22</div>
                        <div class="aspect-square p-1">23</div>
                        <div class="aspect-square p-1">24</div>
                        <div class="aspect-square p-1 bg-primary/10 rounded-md font-medium text-primary">25</div>
                        <div class="aspect-square p-1">26</div>
                        <div class="aspect-square p-1">27</div>
                        <div class="aspect-square p-1">28</div>
                        <div class="aspect-square p-1">29</div>
                        <div class="aspect-square p-1">30</div>
                        <div class="aspect-square p-1">31</div>
                        <div class="aspect-square p-1 text-muted-foreground">1</div>
                    </div>
                </div>
            </div>

            <div class="bg-card rounded-lg border border-border shadow-sm">
                <div class="p-4 border-b border-border">
                    <h3 class="font-medium">Quick Actions</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <a href="create-event.html"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full">
                            <i class="ri-add-line mr-2"></i>
                            Create New Event
                        </a>
                        <button
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full">
                            <i class="ri-mail-line mr-2"></i>
                            Send Event Invitations
                        </button>
                        <button
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full">
                            <i class="ri-file-list-line mr-2"></i>
                            Generate Attendance Report
                        </button>
                        <button
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full">
                            <i class="ri-calendar-line mr-2"></i>
                            View All Events
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection