<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;
    //
    protected $fillable = [
        'name',
        'phone_number',
        'booking_trx_id',
        'is_paid',
        'started_date',
        'ended_date',
        'office_space_id',
        'total_amount',
        'duration'

    ];

    public static function generateBookingTrxId()
    {
        // $lastBookingTransaction = self::latest()->first();
        // $lastBookingTrxId = $lastBookingTransaction ? $lastBookingTransaction->booking_trx_id : null;

        // if ($lastBookingTrxId) {
        //     $lastNumber = (int) substr($lastBookingTrxId, 3);
        //     $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        // } else {
        //     $newNumber = '0001';
        // }

        // return 'TRX' . $newNumber;

        $prefix = 'BO';
        do{
            $randomstring = $prefix . mt_rand(100000, 999999) . date('Ymd');
        }while(self::where('booking_trx_id', $randomstring)->exists());
        return $randomstring;
        
    }

    public function officeSpace() : BelongsTo 
    // ketika setelah function ada huruf s di belakang, itu artinya relasinya one to many. ketika tidak ada huruf s di belakang, itu artinya relasinya one to one
    // belongsTo itu artinya relasinya one to one, karena booking transaction hanya bisa memiliki satu office space. sedangkan office space bisa memiliki banyak booking transaction
    {
        return $this->belongsTo(OfficeSpace::class);
    }
}