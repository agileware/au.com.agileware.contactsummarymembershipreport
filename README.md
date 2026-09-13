# Contact Summary With Membership Type Report (au.com.agileware.contactsummarymembershipreport)

This is a [CiviCRM](https://civicrm.org) extension which adds a custom report to CiviCRM's Report
module. It extends the standard Contact Summary report to also show and filter on a contact's
**Membership Type**, and supports the custom fields available to Individual, Household, and
Organization contacts. This solves the problem of the core Contact Summary report not exposing
Membership Type as a column or filter, requiring a separate Membership report to cross-reference
contacts and their memberships.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Usage

Once installed, a new report template, **Contact Summary With Membership Type Report**, becomes
available in CiviCRM under **Reports > New Report** (or via **Search > New Report**, depending on
your CiviCRM version). Search for "Contact Summary" or "Membership Type" to find it.

The report supports the following, similar to the core Contact Summary report:

* **Columns/Fields** — Contact Name, First/Middle/Last Name, Gender, Birth Date, Age, Contact
  Type, Contact Subtype, Membership Type, Email, Phone/Phone Extension, Address fields, and any
  custom fields configured for Contact, Individual, Household, or Organization contact
  (sub)types.
* **Filters** — Contact Name, Contact Source, Contact ID, Gender, Birth Date, Contact Type,
  Contact Subtype, Membership Type (multi-select), Group, and Tag, in addition to the standard
  address and custom field filters offered by CiviCRM's report filtering.
* **Drilldown** — clicking a contact's name in the report results links through to that contact's
  Constituent Detail Report.

No CiviRules actions, scheduled jobs, or API entities are provided by this extension — it is
solely a report template.

## Special configuration requirements

None. There are no settings pages, credentials, or dependent extensions to configure. Simply
enable the extension and the report template becomes available for use, subject to the normal
CiviCRM report permissions (e.g. `access CiviReport` and any permissions required for the
underlying data, such as `access CiviContribute` for membership data).

## Requirements

* CiviCRM 5.82+ (the version currently declared as compatible in `info.xml`; the report may work
  with earlier versions but has not been verified against them)

## Installation (Web UI)

Learn more about installing CiviCRM extensions in the [CiviCRM Sysadmin
Guide](https://docs.civicrm.org/sysadmin/en/latest/customize/extensions/).

# About the Authors

This CiviCRM extension was developed by the team at
[Agileware](https://agileware.com.au).

[Agileware](https://agileware.com.au) provide a range of CiviCRM
services including:

* CiviCRM migration
* CiviCRM integration
* CiviCRM extension development
* CiviCRM support
* CiviCRM hosting
* CiviCRM remote training services

Support your Australian [CiviCRM](https://civicrm.org) developers,
[contact Agileware](https://agileware.com.au/contact) today!

![Agileware](logo/agileware-logo.png)
