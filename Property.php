<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'property_type',
        'property_status',
        'listed_type',
        'unit_no',
        'street_no',
        'street_name',
        'address',
        'suburb',
        'state',
        'pass_code',
        'created_by',
    ];

    const PROPERTY_TYPE_RESIDENTIAL = 'residential';

    const PROPERTY_TYPE_LAND = 'land';

    const PROPERTY_TYPE_RURAL = 'rural';

    public static function propertyTypes(): array
    {
        return [
            static::PROPERTY_TYPE_RESIDENTIAL => 'Residential',
            static::PROPERTY_TYPE_LAND => 'Land',
            static::PROPERTY_TYPE_RURAL => 'Rural',
        ];
    }

    const LISTED_TYPE_PIPELINE = 'pipeline';

    const LISTED_TYPE_APPRAISAL = 'appraisal';

    const LISTED_TYPE_FOR_RENT = 'for_rent';

    const LISTED_TYPE_FOR_SALE = 'for_sale';

    public static function ListedTypes(): array
    {
        return [
            static::LISTED_TYPE_PIPELINE => 'Pipeline',
            static::LISTED_TYPE_APPRAISAL => 'Appraisal',
            static::LISTED_TYPE_FOR_RENT => 'For Rent',
            static::LISTED_TYPE_FOR_SALE => 'For Sale',
        ];
    }

    const PROPERTY_STATUS_PIPELINE = 'pipeline';

    const PROPERTY_STATUS_APPRAISAL = 'appraisal';

    const PROPERTY_STATUS_PUBLISHED = 'published';

    const PROPERTY_STATUS_DRAFT = 'draft';

    const PROPERTY_STATUS_FOR_RENT = 'for_rent';

    const PROPERTY_STATUS_FOR_SALE = 'for_sale';

    const PROPERTY_STATUS_WITHDRAW = 'withdraw';

    public static function propertyStatus(): array
    {
        return [
            static::PROPERTY_STATUS_PIPELINE => 'Pipeline',
            static::PROPERTY_STATUS_APPRAISAL => 'Appraisal',
            static::PROPERTY_STATUS_PUBLISHED => 'Published',
            static::PROPERTY_STATUS_DRAFT => 'Draft',
            static::PROPERTY_STATUS_FOR_RENT => 'For Rent',
            static::PROPERTY_STATUS_FOR_SALE => 'For Sale',
            static::PROPERTY_STATUS_WITHDRAW => 'Withdraw',
        ];
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($property) {
            $data = [
                'properties_id' => $property->id,
                'created_by' => auth()->id(),
            ];

            PropertyKeyDetail::create($data);

            $marketing_data = [
                'properties_id' => $property->id,
                'created_by' => auth()->id(),
            ];

            $last_inserted = PropertyMarketing::create($marketing_data);
            $marketing_links_data = [
                [
                    'properties_id' => $property->id,
                    'marketing_id'  => $last_inserted->id,
                    'key'           => 'video_link1',
                    'title'         => 'Video link'

                ],
                [
                    'properties_id' => $property->id,
                    'marketing_id'  => $last_inserted->id,
                    'key'           => 'video_link2',
                    'title'         => 'Video link'
                ]
            ];
            PropertyMarketingLink::insert($marketing_links_data);

            // foreach ($marketing_links_data as $value) {
            //     PropertyMarketingLink::create($value);
            // }
        });
    }

    public function propertykeyDetail()
    {
        return $this->belongsTo(PropertyKeyDetail::class, 'id', 'properties_id');
    }

    public function PropertyMarketing()
    {
        return $this->belongsTo(PropertyMarketing::class, 'id', 'properties_id');
    }

    public function PropertyMarketingLink()
    {
        return $this->hasMany(PropertyMarketingLink::class, 'properties_id', 'id');
    }

    public function propertyAuction()
    {
        return $this->hasOne(PropertyAuction::class);
    }

    public function contactProperties()
    {
        return $this->hasMany(ContactProperty::class);
    }
    const SUB_CATEGORY_APARTMENT = 'apartment';

    const SUB_CATEGORY_ACREAGESEMI_RURAL = 'acreagesemi_rural';

    const SUB_CATEGORY_FLAT = 'flat';

    const SUB_CATEGORY_OTHER = 'other';

    const SUB_CATEGORY_TOWNHOUSE = 'townhouse';

    const SUB_CATEGORY_ALPINE = 'alpine';

    const SUB_CATEGORY_BLOCKOFUNITS = 'block_of_units';

    const SUB_CATEGORY_DUPLEXSEMI_DETACHED = 'duplexsemi_detached';

    const SUB_CATEGORY_HOUSE = 'house';

    const SUB_CATEGORY_RETIREMENT = 'retirement';

    const SUB_CATEGORY_SERVICEDAPARTMENT = 'servicedapartment';

    const SUB_CATEGORY_STUDIO = 'studio';

    const SUB_CATEGORY_TERRACE = 'terrace';

    const SUB_CATEGORY_UNIT = 'unit';

    const SUB_CATEGORY_VILLA = 'villa';

    const SUB_CATEGORY_WAREHOUSE = 'warehouse';

    public static function SubCategory(): array
    {
        $assort =  [
            static::SUB_CATEGORY_APARTMENT              => 'Apartment',
            static::SUB_CATEGORY_ACREAGESEMI_RURAL      => 'AcreageSemi-rural',
            static::SUB_CATEGORY_FLAT                   => 'Flat',
            static::SUB_CATEGORY_OTHER                  => 'Other',
            static::SUB_CATEGORY_TOWNHOUSE              => 'Townhouse',
            static::SUB_CATEGORY_ALPINE                 => 'Alpine',
            static::SUB_CATEGORY_BLOCKOFUNITS           => 'BlockOfUnits',
            static::SUB_CATEGORY_DUPLEXSEMI_DETACHED    => 'DuplexSemi-detached',
            static::SUB_CATEGORY_HOUSE                  => 'House',
            static::SUB_CATEGORY_RETIREMENT             => 'Retirement',
            static::SUB_CATEGORY_SERVICEDAPARTMENT      => 'ServicedApartment',
            static::SUB_CATEGORY_STUDIO                 => 'Studio',
            static::SUB_CATEGORY_TERRACE                => 'Terrace',
            static::SUB_CATEGORY_UNIT                   => 'Unit',
            static::SUB_CATEGORY_VILLA                  => 'Villa',
            static::SUB_CATEGORY_WAREHOUSE              => 'Warehouse',
        ];
        asort($assort);
        return $assort;
    }

    public function propertyCategory()
    {
        return $this->hasMany(PropertyCategory::class, 'property_id', 'id');
    }

    public function propertyFeature()
    {
        return $this->hasMany(PropertyFeature::class, 'property_id', 'id');
    }

    public function propertyImage()
    {
        return $this->hasMany(PropertyImage::class, 'property_id', 'id');
    }

    const FEATURES_AIR_CONDITIONING     = 'air_conditioning';
    const FEATURES_BUILT_IN_ROBES       = 'built_in_robes';
    const FEATURES_POOL_INGROUND        = 'pool_inground';
    const FEATURES_RUMPUS_ROOM          = 'rumpus_room';
    const FEATURES_SOLAR_HOT_WATER      = 'solar_hot_water';
    const FEATURES_SOLAR_PANELS         = 'solar_panels';
    const FEATURES_WATER_TANK           = 'water_tank';
    const FEATURES_BALCONY              = 'balcony';
    const FEATURES_COURTYARD            = 'courtyard';
    const FEATURES_DECK                 = 'deck';
    const FEATURES_FULLYFENCED          = 'fullyFenced';
    const FEATURES_OUTDOORENT           = 'outdoorEnt';
    const FEATURES_OUTSIDESPA           = 'outsideSpa';
    const FEATURES_REMOTEGARAGE         = 'remoteGarage';
    const FEATURES_SECUREPARKING        = 'secureParking';
    const FEATURES_SHED                 = 'shed';
    const FEATURES_POOLABOVEGROUND      = 'poolAboveGround';
    const FEATURES_TENNISCOURT          = 'tennisCourt';
    const FEATURES_ALARMSYSTEM          = 'alarmSystem';
    const FEATURES_BROADBAND            = 'broadband';
    const FEATURES_DISHWASHER           = 'dishwasher';
    const FEATURES_VACUUMSYSTEM         = 'vacuumSystem';
    const FEATURES_FLOORBOARDS          = 'floorboards';
    const FEATURES_GYM                  = 'gym';
    const FEATURES_INSIDESPA            = 'insideSpa';
    const FEATURES_INTERCOM             = 'intercom';
    const FEATURES_PAYTV                = 'payTV';
    const FEATURES_STUDY                = 'study';
    const FEATURES_WORKSHOP             = 'workshop';
    const FEATURES_DUCTEDCOOLING        = 'ductedCooling';
    const FEATURES_DUCTEDHEATING        = 'ductedHeating';
    const FEATURES_EVAPORATIVECOOLING   = 'evaporativeCooling';
    const FEATURES_GASHEATING           = 'gasHeating';
    const FEATURES_HYDRONICHEATING      = 'hydronicHeating';
    const FEATURES_OPENFIREPLACE        = 'openFirePlace';
    const FEATURES_REVERSECYCLEAIRCON   = 'reverseCycleAirCon';
    const FEATURES_SPLITSYSTEMAIRCON    = 'splitSystemAirCon';
    const FEATURES_SPLITSYSTEMHEATING   = 'splitSystemHeating';
    const FEATURES_GREYWATERSYSTEM      = 'greyWaterSystem';

    public static function Featurs(): array
    {

        $assort =  [
            static::FEATURES_AIR_CONDITIONING     => 'Air Conditioning',
            static::FEATURES_BUILT_IN_ROBES       => 'Built-in Wardrobes',
            static::FEATURES_POOL_INGROUND        => 'Swimming Pool - In Ground',
            static::FEATURES_RUMPUS_ROOM          => 'Rumpus Room',
            static::FEATURES_SOLAR_HOT_WATER      => 'Solar Hot Water',
            static::FEATURES_SOLAR_PANELS         => 'Solar Panels',
            static::FEATURES_WATER_TANK           => 'Water Tank',
            static::FEATURES_BALCONY              => 'Balcony',
            static::FEATURES_COURTYARD            => 'Courtyard',
            static::FEATURES_DECK                 => 'Deck',
            static::FEATURES_FULLYFENCED          => 'Fully Fenced',
            static::FEATURES_OUTDOORENT           => 'Outdoor Entertainment Area',
            static::FEATURES_OUTSIDESPA           => 'Outside Spa',
            static::FEATURES_REMOTEGARAGE         => 'Remote Garage',
            static::FEATURES_SECUREPARKING        => 'Secure Parking',
            static::FEATURES_SHED                 => 'Shed',
            static::FEATURES_POOLABOVEGROUND      => 'Swimming Pool - Above Ground',
            static::FEATURES_TENNISCOURT          => 'Tennis Court',
            static::FEATURES_ALARMSYSTEM          => 'Alarm System',
            static::FEATURES_BROADBAND            => 'Broadband Internet Available',
            static::FEATURES_DISHWASHER           => 'Dishwasher',
            static::FEATURES_VACUUMSYSTEM         => 'Ducted Vacuum System',
            static::FEATURES_FLOORBOARDS          => 'Floorboards',
            static::FEATURES_GYM                  => 'Gym',
            static::FEATURES_INSIDESPA            => 'Inside Spa',
            static::FEATURES_INTERCOM             => 'Intercom',
            static::FEATURES_PAYTV                => 'Pay TV Access',
            static::FEATURES_STUDY                => 'Study',
            static::FEATURES_WORKSHOP             => 'Workshop',
            static::FEATURES_DUCTEDCOOLING        => 'Ducted Cooling',
            static::FEATURES_DUCTEDHEATING        => 'Ducted Heating',
            static::FEATURES_EVAPORATIVECOOLING   => 'Evaporative Cooling',
            static::FEATURES_GASHEATING           => 'Gas Heating',
            static::FEATURES_HYDRONICHEATING      => 'Hydronic Heating',
            static::FEATURES_OPENFIREPLACE        => 'Open Fireplace',
            static::FEATURES_REVERSECYCLEAIRCON   => 'Reverse Cycle Air Conditioning',
            static::FEATURES_SPLITSYSTEMAIRCON    => 'Split-System Air Conditioning',
            static::FEATURES_SPLITSYSTEMHEATING   => 'Split-System Heating',
            static::FEATURES_GREYWATERSYSTEM      => 'Grey Water System',
        ];
        asort($assort);
        return $assort;
    }

}
