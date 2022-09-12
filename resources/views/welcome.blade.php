<x-app-layout>
    <section class="container">
        <main>
            {{-- <index-category></index-category> --}}
            <app-index :categories="{{$categories}}"></app-index>
        </main>
    </section>
</x-app-layout>