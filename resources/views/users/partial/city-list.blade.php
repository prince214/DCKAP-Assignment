@forelse($cities as $city)
    <option value="{{ $city->id }}">{{ $city->city_name }}</option>
@empty
    <option disabled selected>No City Found</option>
@endforelse
