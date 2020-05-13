<?php

namespace App\Utils;


trait RedcapCaseReportConverter {

  protected static function propertyOrNull($record, $property) {
    return property_exists($record, $property) ? $record->{$property} : null;
  }

  protected static function currentStatus(string $number) {
    if ($number == '2') {
      return 'negative';
    } else if ($number == '3') {
      return 'positive';
    }
    return null;
  }

  protected static function numberToGender(string $number, $formatNum = 1)
  {
    if ($formatNum == 2) {
      switch ($number) {
        case '1':
          return 'male';
        case '2':
          return 'female';
        case '3':
          return 'unknown';
        case '4':
          return 'other';
        default:
          return null;
      }
    }

      switch ($number) {
        case '1':
          return 'male';
        case '2':
          return 'female';
        case '3':
          return 'other';
        case '9':
          return 'unknown';
        default:
          return null;
      }
  }

  protected static function numberToGenderFromField($record, $field, $formatNum) {
    $value = self::propertyOrNull($record, $field);
    return $value ? self::numberToGender($value, $formatNum) : null;
  }

  protected static function numberToYesNo(string $number, $formatNum = 1) {
    if ($formatNum == 2) {
      switch ($number) {
        case '1':
          return 'no';
        case '2':
          return 'yes';
        default:
          return null;
      }
    }

    if ($formatNum == 3) {
      switch ($number) {
        case '1':
          return 'no';
        case '2':
          return 'yes';
        case '3':
          return 'unknown';
        default:
          return null;
      }
    }

    switch ($number) {
      case '0':
        return 'no';
      case '1':
        return 'yes';
      case '9':
        return 'unknown';
      case '10':
        return 'not_applicable';
      default:
          return null;
    }
  }

  protected static function numberToYesNoAlt(string $number) {
    if ($number == '1') {
      return 'no';
    } else if ($number == '2') {
      return 'yes';
    }
    return null;
  }

  protected static function numberToBloodtype(string $number) {
    switch ($number) {
      case '1': return 'A+';
      case '2': return 'B+';
      case '3': return 'O+';
      case '4': return 'AB+';
      case '5': return 'A-';
      case '6': return 'B-';
      case '7': return 'O-';
      case '8': return 'AB-';
      default: return null;
    }
  }

  protected static function numberToDoseUnit(string $number) {
    switch ($number) {
      case '0': return 'application';
      case '1': return 'cap';
      case '2': return 'mg';
      case '3': return 'min';
      case '4': return 'mL';
      case '5': return 'puff';
      case '6': return 'softgel';
      case '7': return 'spray';
      case '8': return 'tab';
      case '9': return 'unit';
      case '10': return 'vial';
      default: return null;
    }
  }

  protected static function numberToDoseRoute(string $number) {
    // '2' not used
    switch ($number) {
      case '0': return 'GT';
      case '1': return 'NG';
      case '3': return 'TO';
      case '4': return 'IM';
      case '5': return 'IV';
      case '6': return 'NAS';
      case '7': return 'PO';
      case '8': return 'IN';
      case '9': return 'SQ';
      case '10': return 'RE';
      case '11': return 'IH';
      default: return null;
    }
  }

  protected static function numberToDoseFrequency(string $number) {
    switch ($number) {
      case '0': return 'QD';
      case '1': return 'BID';
      case '2': return 'TID';
      case '3': return 'QID';
      case '4': return 'PRN';
      case '9': return 'QMon/Wed/Fri';
      case '10': return 'QMonth';
      case '11': return 'Once';
      default: return null;
    }
  }

  protected static function numberToExamination(string $number) {
    switch ($number) {
      case '1': return 'normal';
      case '2': return 'abnormal, not clinically significant';
      case '3': return 'abnorma, clinically significant';
      case '4': return 'not assessed';
      default: return null;
    }
  }

  protected static function numberToSymptomStatus(string $number) {
    switch ($number) {
      case '0': return 'symptomatic';
      case '1': return 'asymptomatic';
      case '9': return 'unknown';
      default: return null;
    }
  }

  protected static function numberToSymptomResolution(string $number) {
    switch ($number) {
      case '0': return 'symptom_resolved_unknown_date';
      case '1': return 'still_symptomatic';
      case '9': return 'unknown_symptom_status';
      case '10': return 'symptoms_resolved_with_date';
      default: return null;
    }
  }

  protected static function numberToAffected(string $number) {
    switch ($number) {
      case '1': return 'covid_19_positive';
      case '2': return 'covid_19_negative';
      case '3': return 'not_tested';
      case '4': return 'unknown';
      case '5': return 'not_applicable';
      default: return null;
    }
  }

  protected static function extractMedicalHistoryOther($record, $index) {
    $properties = [];
    switch ($index) {
      case 1:
        $properties = [
          'history'                  => 'med_hx_1',
          'condition'                => 'medhx_condition1',
          'condition_onset_date'     => 'condition_onsetdate1',
          'present_at_time_of_covid' => 'present_at_the_time_of_cov',
          'condition_worsened'       => 'was_this_condition_worsene',
          'status'                   => 'status'
        ];
        break;

      case 2:
        $properties = [
          'history'                  => 'med_hx_2',
          'condition'                => 'medhx_condition2',
          'condition_onset_date'     => 'condition_onsetdate11',
          'present_at_time_of_covid' => 'present_at_the_time_of_cov_2',
          'condition_worsened'       => 'was_this_condition_worsene_2',
          'status'                   => 'status_2'
        ];
        break;

      case 3:
        $properties = [
          'history'                  => 'med_hx_3',
          'condition'                => 'medhx_condition3',
          'condition_onset_date'     => 'condition_onsetdate12',
          'present_at_time_of_covid' => 'present_at_the_time_of_cov_3',
          'condition_worsened'       => 'was_this_condition_worsene_3',
          'status'                   => 'status_3'
        ];
        break;

      case 4:
        $properties = [
          'history'                  => 'med_hx_4',
          'condition'                => 'medhx_condition4',
          'condition_onset_date'     => 'condition_onsetdate13',
          'present_at_time_of_covid' => 'present_at_the_time_of_cov_4',
          'condition_worsened'       => 'was_this_condition_worsene_4',
          'status'                   => 'status_4'
        ];
        break;

      case 5:
        $properties = [
          'history'                  => 'med_hx_5',
          'condition'                => 'medhx_condition5',
          'condition_onset_date'     => 'condition_onsetdate14',
          'present_at_time_of_covid' => 'present_at_the_time_of_cov_5',
          'condition_worsened'       => 'was_this_condition_worsene_5',
          'status'                   => 'status_5'
        ];
        break;

      default:
        throw new \Error("invalid index for medical history other: $index");
    }

    $result = [];
    foreach ($properties as $new_property => $old_property) {
      $result[$new_property] = property_exists($record, $old_property) ? $record->{$old_property} : null;
    }
    return (object) $result;
  }

  protected static function extractConcominantMedications($record, $index) {
    $properties = [];
    switch ($index) {
      case 1:
        $properties = [
          'name'            => 'conmed_other_1',
          'indication'      => 'conmed_indication_1',
          'resp_complaint'  => 'conmed_respcomplaint_1',
          'dose_amt'        => 'conmed_dose_amt_1',
          'dose_unit'       => 'conmed_dose_unit_1',
          'dose_route'      => 'conmed_dose_route_1',
          'dose_frequency'  => 'conmed_dose_frequency_1',
          'dose_start_date' => 'conmed_dose_start_date_1',
          'dose_stop_check' => 'conmed_dose_stop_check_1',
          'dose_stop_date'  => 'conmed_dose_stop_date_1'
        ];
        break;

      case 2:
        $properties = [
          'name'            => 'conmed_other_2',
          'indication'      => 'conmed_indication_2',
          'resp_complaint'  => 'conmed_respcomplaint_2',
          'dose_amt'        => 'conmed_dose_amt_2',
          'dose_unit'       => 'conmed_dose_unit_2',
          'dose_route'      => 'conmed_dose_route_2',
          'dose_frequency'  => 'conmed_dose_frequency_2',
          'dose_start_date' => 'conmed_dose_start_date_2',
          'dose_stop_check' => 'conmed_dose_stop_check_2',
          'dose_stop_date'  =>'conmed_dose_stop_date_2'
        ];
        break;

      case 3:
        $properties = [
          'name'            => 'conmed_other_3',
          'indication'      => 'conmed_indication_3',
          'resp_complaint'  => 'conmed_respcomplaint_3',
          'dose_amt'        => 'conmed_dose_amt_3',
          'dose_unit'       => 'conmed_dose_unit_3',
          'dose_route'      => 'conmed_dose_route_3',
          'dose_frequency'  => 'conmed_dose_frequency_3',
          'dose_start_date' => 'conmed_dose_start_date_3',
          'dose_stop_check' => 'conmed_dose_stop_check_3',
          'dose_stop_date'  =>'conmed_dose_stop_date_3'
        ];
        break;

      case 4:
        $properties = [
          'name'            => 'conmed_other_4',
          'indication'      => 'conmed_indication_4',
          'resp_complaint'  => 'conmed_respcomplaint_4',
          'dose_amt'        => 'conmed_dose_amt_4',
          'dose_unit'       => 'conmed_dose_unit_4',
          'dose_route'      => 'conmed_dose_route_4',
          'dose_frequency'  => 'conmed_dose_frequency_4',
          'dose_start_date' => 'conmed_dose_start_date_4',
          'dose_stop_check' => 'conmed_dose_stop_check_4',
          'dose_stop_date'  =>'conmed_dose_stop_date_4'
        ];
        break;

      case 5:
        $properties = [
          'name'            => 'conmed_other_5',
          'indication'      => 'conmed_indication_5',
          'resp_complaint'  => 'conmed_respcomplaint_5',
          'dose_amt'        => 'conmed_dose_amt_5',
          'dose_unit'       => 'conmed_dose_unit_5',
          'dose_route'      => 'conmed_dose_route_5',
          'dose_frequency'  => 'conmed_dose_frequency_5',
          'dose_start_date' => 'conmed_dose_start_date_5',
          'dose_stop_check' => 'conmed_dose_stop_check_5',
          'dose_stop_date'  =>'conmed_dose_stop_date_5'
        ];
        break;

      default:
        throw new \Error("invalid index for concominant medication: $index");
    }

    $result = [];
    foreach ($properties as $new_property => $old_property) {
      $result[$new_property] = property_exists($record, $old_property) ? $record->{$old_property} : null;
    }

    $result['resp_complaint']  = self::numberToYesNo($result['resp_complaint']);
    $result['dose_unit']       = self::numberToDoseUnit($result['dose_unit']);
    $result['dose_route']      = self::numberToDoseRoute($result['dose_route']);
    $result['dose_frequency']  = self::numberToDoseFrequency($result['dose_frequency']);
    $result['dose_stop_check'] = self::numberToYesNo($result['dose_stop_check']);

    return (object) $result;
  }

  protected static function numberToSwabResult(string $number, $formatNum = 1) {
    if ($formatNum == 2) {
      switch ($number) {
        case '1': return 'positive';
        case '2': return 'negative';
        case '3': return 'not_done';
        case '4': return 'indeterminate';
        default:
          return null;
      }
    }

    switch ($number) {
      case '1': return 'positive';
      case '2': return 'negative';
      case '3': return 'pending';
      case '4': return 'not_done';
      case '5': return 'indeterminate';
      default: return null;
    }
  }

  protected static function extractSwabSample($record, $index) {
    $properties = [];
    switch ($index) {
      case 1:
        $properties = [
          'swab_id'         => 'spec_npswab1id',
          'swab_date'       => 'spec_npswab1_dt',
          'processing_date' => 'np_processing',
          'result'          => 'spec_npswab1stateresult'
        ];
        break;

      case 2:
        $properties = [
          'swab_id'         => 'spec_npswab1id_2',
          'swab_date'       => 'spec_npswab2_dt',
          'processing_date' => 'np_processing_2',
          'result'          => 'spec_npswab2stateresult'
        ];
        break;

      case 3:
        $properties = [
          'swab_id'         => 'spec_npswab3id',
          'swab_date'       => 'spec_npswab3_dt',
          'processing_date' => 'np_processing_3',
          'result'          => 'spec_npswab3stateresult'
        ];
        break;

      default:
        throw new \Error("invalid index for concominant medication: $index");
    }

    $result = [];
    foreach ($properties as $new_property => $old_property) {
      $result[$new_property] = property_exists($record, $old_property) ? $record->{$old_property} : null;
    }

    $result['result']  = self::numberToSwabResult($result['result']);
    return (object) $result;
  }

  protected static function extractBloodSample($record, $index) {
    $properties = [];
    switch ($index) {
      case 1:
        $properties = [
          'blood_id' => 'blood_id',
          'blood_date' => 'blood_date',
          'blood_processing' => 'blood_processing',
        ];
        break;

      case 2:
      case 3:
      case 4:
      case 5:
      case 6:
      case 7:
      case 8:
      case 9:
      case 10:
        $properties = [
          'blood_id'         => "blood_id_$index",
          'blood_date'       => "blood_date_$index",
          'blood_processing' => "blood_processing_$index",
        ];
        break;

      default:
        throw new \Error("invalid index for concominant medication: $index");
    }

    $result = [];
    foreach ($properties as $new_property => $old_property) {
      $result[$new_property] = property_exists($record, $old_property) ? $record->{$old_property} : null;
    }

    return (object) $result;
  }

  protected static function numberToCaseReportComplete(string $number) {
    switch ($number) {
      case '0': return 'incomplete';
      case '1': return 'unverified';
      case '2': return 'complete';
      default: return null;
    }
  }

  protected static function numberToTestResults(string $number) {
    switch ($number) {
      case '1': return 'positive';
      case '2': return 'negative';
      default: return null;
    }
  }

  protected static function numberToPracticeComplete(string $number) {
    switch ($number) {
      case '0': return 'incomplete';
      case '1': return 'unverified';
      case '2': return 'complete';
      default: return null;
    }
  }

}