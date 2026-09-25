# Contact Summary With Membership Type Report (au.com.agileware.contactsummarymembershipreport)

This is a [CiviCRM](https://civicrm.org) extension which adds a custom report to CiviCRM's Report
module. It extends the standard Contact Summary report to also show and filter on a contact's
membership details — Membership Type, Status, dates, and more — and supports the custom fields
available to Individual, Household, and Organization contacts. This solves the problem of the
core Contact Summary report not exposing membership information as a column or filter, requiring
a separate Membership report to cross-reference contacts and their memberships.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Usage

Once installed, a new report template, **Contact Summary With Membership Type Report**, becomes
available in CiviCRM under **Reports > New Report** (or via **Search > New Report**, depending on
your CiviCRM version). Search for "Contact Summary" or "Membership Type" to find it.

The report supports the following, similar to the core Contact Summary report. On both the
**Columns** and **Filters** tabs, fields are grouped into sections in this order: Contact fields,
Contact Address fields, a **Memberships** section, then any Custom fields.

* **Columns/Fields** — Contact Name, First/Middle/Last Name, Gender, Birth Date, Age, Contact
  Type, Contact Subtype, Job Title, External ID, Email, Phone/Phone Extension, Address fields, any
  custom fields configured for Contact, Individual, Household, or Organization contact (sub)types,
  and, under **Memberships**: Membership Type, Membership Status, Member Since, Membership Start
  Date, Membership Expiration Date, Membership Source, Primary Member (Primary/Inherited), Status
  Override, and Status Override End Date.
* **Filters** — Contact Name, Contact Source, Contact ID, Gender, Birth Date, Contact Type,
  Contact Subtype, Job Title, External ID, Group, and Tag, in addition to the standard address and
  custom field filters offered by CiviCRM's report filtering, plus under **Memberships**:
  Membership Type (multi-select), Membership Status (multi-select), Is Current Member (yes/no),
  Member Since, Membership Start Date, Membership Expiration Date, Membership Source, Primary
  Member, Status Override (yes/no), and Status Override End Date.
* **Sorting** — the report's Order By Columns criteria is limited to Last Name/First Name
  (the default sort), Membership Status, Membership Type, Country, State/Territory, and Gender.
  Any of these can also be checked as a **Section Header / Group By** to group the results into
  headed, totaled sections (including combining more than one, e.g. grouping by Country and then
  by Gender within each country).
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

* CiviCRM 6.16+ (the version currently declared as compatible in `info.xml`; the report may work
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
