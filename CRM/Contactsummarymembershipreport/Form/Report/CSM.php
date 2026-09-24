<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.6                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2015                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2015
 * $Id$
 *
 */
class CRM_Contactsummarymembershipreport_Form_Report_CSM extends CRM_Report_Form {

  public $_summary = NULL;

  protected $_emailField = FALSE;

  protected $_phoneField = FALSE;

  protected $_customGroupExtends = [
    'Contact',
    'Individual',
    'Household',
    'Organization',
  ];

  public $_drilldownReport = ['contact/detail' => 'Link to Detail Report'];

  /**
   */
  public function __construct() {
    $this->_autoIncludeIndexedFieldsAsOrderBys = 0;
    $this->_columns = [
      'civicrm_contact' => [
        'dao' => 'CRM_Contact_DAO_Contact',
        'fields' => [
          'sort_name' => [
            'title' => ts('Contact Name'),
            'required' => TRUE,
            'no_repeat' => TRUE,
          ],
          'first_name' => [
            'title' => ts('First Name'),
          ],
          'middle_name' => [
            'title' => ts('Middle Name'),
          ],
          'last_name' => [
            'title' => ts('Last Name'),
          ],
          'id' => [
            'no_display' => TRUE,
            'required' => TRUE,
          ],
          'gender_id' => [
            'title' => ts('Gender'),
          ],
          'birth_date' => [
            'title' => ts('Birth Date'),
          ],
          'age' => [
            'title' => ts('Age'),
            'dbAlias' => 'TIMESTAMPDIFF(YEAR, contact_civireport.birth_date, CURDATE())',
          ],
          'contact_type' => [
            'title' => ts('Contact Type'),
          ],
          'contact_sub_type' => [
            'title' => ts('Contact Subtype'),
          ],
        ],
        'filters' => [
          'sort_name' => ['title' => ts('Contact Name')],
          'source' => [
            'title' => ts('Contact Source'),
            'type' => CRM_Utils_Type::T_STRING,
          ],
          'id' => [
            'title' => ts('Contact ID'),
            'no_display' => TRUE,
          ],
          'gender_id' => [
            'title' => ts('Gender'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'gender_id'),
          ],
          'birth_date' => [
            'title' => ts('Birth Date'),
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'contact_type' => [
            'title' => ts('Contact Type'),
          ],
          'contact_sub_type' => [
            'title' => ts('Contact Subtype'),
          ],
        ],
        'grouping' => 'contact-fields',
        'order_bys' => [
          'sort_name' => [
            'title' => ts('Last Name, First Name'),
            'default' => '1',
            'default_weight' => '0',
            'default_order' => 'ASC',
          ],
          'gender_id' => [
            'name' => 'gender_id',
            'title' => ts('Gender'),
          ],
        ],
      ],
      'civicrm_email' => [
        'dao' => 'CRM_Core_DAO_Email',
        'fields' => [
          'email' => [
            'title' => ts('Email'),
            'no_repeat' => TRUE,
          ],
        ],
        'grouping' => 'contact-fields',
      ],
      'civicrm_phone' => [
        'dao' => 'CRM_Core_DAO_Phone',
        'fields' => [
          'phone' => NULL,
          'phone_ext' => [
            'title' => ts('Phone Extension'),
          ],
        ],
        'grouping' => 'contact-fields',
      ],
    ];

    $addressColumns = $this->getAddressColumns(['group_by' => FALSE, 'order_bys' => FALSE]);
    $addressColumns['civicrm_address']['order_bys'] = [
      'address_country_id' => [
        'name' => 'country_id',
        'title' => ts('Country'),
        'type' => CRM_Utils_Type::T_INT,
      ],
      'address_state_province_id' => [
        'name' => 'state_province_id',
        'title' => ts('State/Territory'),
        'type' => CRM_Utils_Type::T_INT,
      ],
    ];

    $this->_columns = $this->_columns + $addressColumns + [
      'civicrm_membership' => [
        'dao' => 'CRM_Member_DAO_Membership',
        'grouping' => 'member-fields',
        'group_title' => ts('Memberships'),
        'fields' => [
          'membership_type_id' => [
            'title' => ts('Membership Type'),
            'no_repeat' => TRUE,
          ],
          'status_id' => [
            'title' => ts('Membership Status'),
          ],
          'join_date' => [
            'title' => ts('Member Since'),
          ],
          'start_date' => [
            'title' => ts('Membership Start Date'),
          ],
          'end_date' => [
            'title' => ts('Membership Expiration Date'),
          ],
          'membership_source' => [
            'name' => 'source',
            'title' => ts('Membership Source'),
          ],
          'owner_membership_id' => [
            'title' => ts('Primary Member'),
          ],
          'is_override' => [
            'title' => ts('Status Override'),
          ],
          'status_override_end_date' => [
            'title' => ts('Status Override End Date'),
          ],
        ],
        'filters' => [
          'membership_type_id' => [
            'title' => ts('Membership Type'),
            'type' => CRM_Utils_Type::T_INT,
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Member_PseudoConstant::membershipType(),
          ],
          'status_id' => [
            'title' => ts('Membership Status'),
            'type' => CRM_Utils_Type::T_INT,
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Member_PseudoConstant::membershipStatus(NULL, NULL, 'label'),
          ],
          'join_date' => [
            'title' => ts('Member Since'),
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'start_date' => [
            'title' => ts('Membership Start Date'),
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'end_date' => [
            'title' => ts('Membership Expiration Date'),
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'membership_source' => [
            'name' => 'source',
            'title' => ts('Membership Source'),
            'type' => CRM_Utils_Type::T_STRING,
          ],
          'owner_membership_id' => [
            'title' => ts('Primary Member'),
            'type' => CRM_Utils_Type::T_INT,
            'operatorType' => CRM_Report_Form::OP_INT,
          ],
          'is_override' => [
            'title' => ts('Status Override'),
            'type' => CRM_Utils_Type::T_BOOLEAN,
          ],
          'status_override_end_date' => [
            'title' => ts('Status Override End Date'),
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
        ],
        'order_bys' => [
          'membership_type_id' => [
            'name' => 'membership_type_id',
            'title' => ts('Membership Type'),
            'type' => CRM_Utils_Type::T_INT,
          ],
          'status_id' => [
            'name' => 'status_id',
            'title' => ts('Membership Status'),
            'type' => CRM_Utils_Type::T_INT,
          ],
        ],
      ],
      'civicrm_membership_status' => [
        'dao' => 'CRM_Member_DAO_MembershipStatus',
        'grouping' => 'member-fields',
        'group_title' => ts('Memberships'),
        'filters' => [
          'is_current_member' => [
            'title' => ts('Is Current Member'),
            'type' => CRM_Utils_Type::T_BOOLEAN,
          ],
        ],
      ],
    ];

    $this->_groupFilter = TRUE;
    $this->_tagFilter = TRUE;
    parent::__construct();
  }

  public function preProcess() {
    parent::preProcess();
  }

  public function select() {
    $select = [];
    $this->_columnHeaders = [];
    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('fields', $table)) {
        foreach ($table['fields'] as $fieldName => $field) {
          if (!empty($field['required']) ||
            !empty($this->_params['fields'][$fieldName])
          ) {
            if ($tableName == 'civicrm_email') {
              $this->_emailField = TRUE;
            }
            elseif ($tableName == 'civicrm_phone') {
              $this->_phoneField = TRUE;
            }
            elseif ($tableName == 'civicrm_country') {
              $this->_countryField = TRUE;
            }

            $alias = "{$tableName}_{$fieldName}";
            $select[] = "{$field['dbAlias']} as {$alias}";
            $this->_columnHeaders["{$tableName}_{$fieldName}"]['type'] = $field['type'] ?? NULL;
            $this->_columnHeaders["{$tableName}_{$fieldName}"]['title'] = $field['title'];
            $this->_selectAliases[] = $alias;
          }
        }
      }
    }

    $this->_select = "SELECT " . implode(', ', $select) . " ";
  }

  /**
   * @param $fields
   * @param $files
   * @param $self
   *
   * @return array
   */
  public static function formRule($fields, $files, $self) {
    $errors = $grouping = [];
    return $errors;
  }

  public function from() {
    $this->_from = "
        FROM civicrm_contact {$this->_aliases['civicrm_contact']} {$this->_aclFrom}
	    LEFT JOIN civicrm_membership {$this->_aliases['civicrm_membership']}
                          ON {$this->_aliases['civicrm_contact']}.id =
                             {$this->_aliases['civicrm_membership']}.contact_id AND {$this->_aliases['civicrm_membership']}.is_test = 0
            LEFT JOIN civicrm_address {$this->_aliases['civicrm_address']}
                   ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_address']}.contact_id AND
                      {$this->_aliases['civicrm_address']}.is_primary = 1 ) ";

    if ($this->isTableSelected('civicrm_email')) {
      $this->_from .= "
            LEFT JOIN  civicrm_email {$this->_aliases['civicrm_email']}
                   ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_email']}.contact_id AND
                      {$this->_aliases['civicrm_email']}.is_primary = 1) ";
    }

    if ($this->_phoneField) {
      $this->_from .= "
            LEFT JOIN civicrm_phone {$this->_aliases['civicrm_phone']}
                   ON {$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_phone']}.contact_id AND
                      {$this->_aliases['civicrm_phone']}.is_primary = 1 ";
    }

    if ($this->isTableSelected('civicrm_country')) {
      $this->_from .= "
            LEFT JOIN civicrm_country {$this->_aliases['civicrm_country']}
                   ON {$this->_aliases['civicrm_address']}.country_id = {$this->_aliases['civicrm_country']}.id AND
                      {$this->_aliases['civicrm_address']}.is_primary = 1 ";
    }

    if ($this->isTableSelected('civicrm_membership_status')) {
      $this->_from .= "
            LEFT JOIN civicrm_membership_status {$this->_aliases['civicrm_membership_status']}
                   ON {$this->_aliases['civicrm_membership']}.status_id = {$this->_aliases['civicrm_membership_status']}.id ";
    }
  }

  public function postProcess() {

    $this->beginPostProcess();

    // get the acl clauses built before we assemble the query
    $this->buildACLClause($this->_aliases['civicrm_contact']);

    $sql = $this->buildQuery(TRUE);

    $rows = $graphRows = [];
    $this->buildRows($sql, $rows);

    $this->formatDisplay($rows);
    $this->doTemplateAssignment($rows);
    $this->endPostProcess($rows);
  }

  /**
   * Build array of section totals for multi-level Section Headers.
   *
   * This duplicates CRM_Report_Form::sectionTotals(), which never
   * increments the loop counter used to detect the lowest-level section
   * alias. That means every alias - not just the higher-level ones - takes
   * the "roll count into total" branch below, reading $totals[$key] before
   * it has been initialised for that key and triggering an "Undefined
   * array key" warning under PHP 8.1+ whenever two or more columns are
   * used as Section Headers at once. The running total ends up correct
   * either way (each key is only encountered once, since the query is
   * grouped by all section aliases), so the only fix needed here is to
   * default a missing total to 0 instead of reading it unset.
   */
  public function sectionTotals() {
    if (empty($this->_selectAliases)) {
      return;
    }

    if (!empty($this->_sections)) {
      $select = str_ireplace('SELECT SQL_CALC_FOUND_ROWS ', 'SELECT ', $this->_select);
      $sql = "{$select} {$this->_from} {$this->_where} {$this->_groupBy} {$this->_having} {$this->_orderBy}";

      $sectionAliases = array_keys($this->_sections);

      $ifnulls = [];
      foreach (array_merge($sectionAliases, $this->_selectAliases) as $alias) {
        $ifnulls[] = "ifnull($alias, '') as $alias";
      }
      $this->_select = "SELECT " . implode(", ", $ifnulls);
      $this->_select = CRM_Contact_BAO_Query::appendAnyValueToSelect($ifnulls, $sectionAliases);

      $query = $this->_select .
        ", count(*) as ct from ($sql) as subquery group by " .
        implode(", ", $sectionAliases);

      $totals = [];
      $dao = CRM_Core_DAO::executeQuery($query);
      while ($dao->fetch()) {
        $rows[0] = $dao->toArray();
        $this->alterDisplay($rows);
        $this->alterCustomDataDisplay($rows);
        $row = $rows[0];

        $values = [];
        $i = 1;
        $aliasCount = count($sectionAliases);
        foreach ($sectionAliases as $alias) {
          $values[] = $row[$alias];
          $key = implode(CRM_Core_DAO::VALUE_SEPARATOR, $values);
          if ($i == $aliasCount) {
            $totals[$key] = $dao->ct;
          }
          else {
            $totals[$key] = ($totals[$key] ?? 0) + $dao->ct;
          }
          $i++;
        }
      }
      $this->assign('sectionTotals', $totals);
    }
  }

  /**
   * @param $rows
   *
   * @return bool
   */
  private function _initBasicRow(&$rows, &$entryFound, $row, $rowId, $rowNum, $types) {
    if (!array_key_exists($rowId, $row)) {
      return FALSE;
    }

    $value = $row[$rowId];
    // Always assign an explicit value (rather than leaving it null) so that
    // section headers/totals (which compare/key on this value) behave
    // consistently for rows with no value set.
    $rows[$rowNum][$rowId] = $value ? $types[$value] : '';
    $entryFound = TRUE;
  }

  /**
   * Alter display of rows.
   *
   * Iterate through the rows retrieved via SQL and make changes for display purposes,
   * such as rendering contacts as links.
   *
   * @param array $rows
   *   Rows generated by SQL, with an array for each row.
   */
  public function alterDisplay(&$rows) {
    $entryFound = FALSE;

    $genders = CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'gender_id', ['localize' => TRUE]);

    foreach ($rows as $rowNum => $row) {
      // make count columns point to detail report
      // convert sort name to links
      if (array_key_exists('civicrm_contact_sort_name', $row) &&
        array_key_exists('civicrm_contact_id', $row)
      ) {
        $url = CRM_Report_Utils_Report::getNextUrl('contact/detail',
          'reset=1&force=1&id_op=eq&id_value=' . $row['civicrm_contact_id'],
          $this->_absoluteUrl, $this->_id, $this->_drilldownReport
        );
        $rows[$rowNum]['civicrm_contact_sort_name_link'] = $url;
        $rows[$rowNum]['civicrm_contact_sort_name_hover'] = ts("View Constituent Detail Report for this contact.");
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_address_address_state_province_id', $row)) {
        $value = $row['civicrm_address_address_state_province_id'];
        // Core's generic alter_display mechanism (getAddressColumns()'s
        // 'alter_display' => 'alterStateProvinceID') already converts this
        // to a name on the main results path before this method runs, so
        // only convert when we still have a raw numeric id - which is the
        // case when CRM_Report_Form::sectionTotals() calls this method
        // directly on its own freshly-queried, unconverted rows.
        if (is_numeric($value)) {
          $rows[$rowNum]['civicrm_address_address_state_province_id'] = CRM_Core_PseudoConstant::stateProvince($value, FALSE);
        }
        elseif ($value === NULL) {
          $rows[$rowNum]['civicrm_address_address_state_province_id'] = '';
        }
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_membership_membership_type_id', $row)) {
        $value = $row['civicrm_membership_membership_type_id'];
        if ($value) {
          $value = explode(',', $value);
          foreach ($value as $key => $id) {
            $value[$key] = CRM_Member_PseudoConstant::membershipType($id, FALSE);
          }
          $value = implode(' , ', $value);
        }
        $rows[$rowNum]['civicrm_membership_membership_type_id'] = $value ?: '';
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_membership_status_id', $row)) {
        $value = $row['civicrm_membership_status_id'];
        $rows[$rowNum]['civicrm_membership_status_id'] = $value ? CRM_Member_PseudoConstant::membershipStatus($value, NULL, 'label', FALSE) : '';
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_membership_owner_membership_id', $row)) {
        $rows[$rowNum]['civicrm_membership_owner_membership_id'] = !empty($row['civicrm_membership_owner_membership_id']) ? ts('Inherited') : ts('Primary');
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_membership_is_override', $row)) {
        $rows[$rowNum]['civicrm_membership_is_override'] = !empty($row['civicrm_membership_is_override']) ? ts('Yes') : ts('No');
        $entryFound = TRUE;
      }

      // display membership dates using the site's default report date format
      foreach (['civicrm_membership_join_date', 'civicrm_membership_start_date', 'civicrm_membership_end_date', 'civicrm_membership_status_override_end_date'] as $dateField) {
        if (array_key_exists($dateField, $row)) {
          if ($row[$dateField]) {
            $rows[$rowNum][$dateField] = CRM_Utils_Date::customFormat($row[$dateField]);
          }
          $entryFound = TRUE;
        }
      }

      if (array_key_exists('civicrm_address_address_country_id', $row)) {
        $value = $row['civicrm_address_address_country_id'];
        // See the state/province handling above for why this only converts
        // when $value is still a raw numeric id.
        if (is_numeric($value)) {
          $rows[$rowNum]['civicrm_address_address_country_id'] = CRM_Core_PseudoConstant::country($value, FALSE);
        }
        elseif ($value === NULL) {
          $rows[$rowNum]['civicrm_address_address_country_id'] = '';
        }
        $entryFound = TRUE;
      }

      // handle gender id
      $this->_initBasicRow($rows, $entryFound, $row, 'civicrm_contact_gender_id', $rowNum, $genders);

      // display birthday using the site's default report date format
      if (array_key_exists('civicrm_contact_birth_date', $row)) {
        $birthDate = $row['civicrm_contact_birth_date'];
        if ($birthDate) {
          $rows[$rowNum]['civicrm_contact_birth_date'] = CRM_Utils_Date::customFormat($birthDate);
        }
        $entryFound = TRUE;
      }

      // skip looking further in rows, if first row itself doesn't
      // have the column we need
      if (!$entryFound) {
        break;
      }
    }
  }

}
