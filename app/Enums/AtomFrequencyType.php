<?php

namespace App\Enums;

enum AtomFrequencyType: string {
    // Daily frequencies
    case Daily = 'daily';
    case TwiceDaily = 'twice daily';
    case ThreeTimesDaily = 'three times daily';
    case FourTimesDaily = 'four times daily';

    // Weekly frequencies
    case Weekly = 'weekly';
    case TwiceWeekly = 'twice weekly';
    case ThreeTimesWeekly = 'three times weekly';
    case FourTimesWeekly = 'four times weekly';
    case FiveTimesWeekly = 'five times weekly';
    case SixTimesWeekly = 'six times weekly';

    // Fortnightly
    case Fortnightly = 'fortnightly';

    // Monthly frequencies
    case Monthly = 'monthly';
    case TwiceMonthly = 'twice monthly';
    case ThreeTimesMonthly = 'three times monthly';

    // Other
    case Weekdays = 'weekdays';
    case Weekends = 'weekends';
}