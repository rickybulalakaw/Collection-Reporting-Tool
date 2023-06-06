## Collection Reporting Tool 

This application aims to assist collection officers submit report of collections and deposits and personnel consolidating individual Report of Collections and Deposits (RCD) into Consolidated RCD and Monthly Abstract. 

## Project Details

### Status

The application is currently on development stage. Among others, the interface uses Boostrap. This shall be updated to TailwindCSS upon completion of functions. 

### Deployment Details 

The system was developed using Laravel's Sail package. Thus, the production host should have Docker Engine installed. 

### Modifications during Deployment 

1. Assuming the system will be deployed with Docker using Sail, the owner of the storage folder should be changed to www-data:www-data 
2. (To be determined)

## Functions

1. Input details of collections by accountable form types, with specific forms for RPT Receipt, Cash Ticket, Community Tax Certificate, and Official Receipt for other cash receipts. (Done)
2. Generate individual RCD 
3. Review individual RCD (by consolidator/internal audit)
4. Review individual accountable forms (by reviewer/consolidator) 
5. Generate monthly abstract 
6. Generate MTD analytical charts 

## Credits

This application uses primarily Laravel with Jetstream (with Tailwind, AlpineJS and Livewire) and Sail. It also utilizes ChartJS (This will be updated).