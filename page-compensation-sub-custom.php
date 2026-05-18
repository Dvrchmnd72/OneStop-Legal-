<?php
/**
 * Template Name: Compensation Sub-Service - Custom
 *
 * Shared template for all Compensation sub-service pages
 */

get_header();
?>
<div style="background:linear-gradient(135deg,#0d1b3e,#1a2a4a);padding:18px;text-align:center;display:flex;align-items:center;justify-content:center;gap:25px;flex-wrap:wrap;">
  <span style="color:#fff;font-size:13px;font-weight:600;">&#x2705; No Win, No Fee</span>
  <span style="color:#fff;font-size:13px;font-weight:600;">&#x2696;&#xFE0F; Queensland Law Specialists</span>
  <span style="color:#fff;font-size:13px;font-weight:600;">&#x1F512; 100% Confidential</span>
  <span style="color:#fff;font-size:13px;font-weight:600;">&#x26A1; Free Consultation</span>
  <span style="color:#ff9f43;font-size:13px;font-weight:600;">&#x23F0; Time Limits Apply &mdash; Act Now</span>
</div>
<?php

$page_data = [];

$page_data[2526] = [
  "title" => "Personal Injury Claims",
  "subtitle" => "Get the Compensation You Deserve",
  "hero_desc" => "If you have been injured in an accident caused by someone else's negligence, our experienced personal injury lawyers will fight to secure fair compensation for your injuries, losses, and suffering.",
  "icon" => "&#x1F489;",
  "intro_heading" => "Expert Legal Support for <span>Personal Injury Claims</span>",
  "intro_p1" => "At <strong>OneStop Legal</strong>, we are committed to helping individuals who have suffered personal injuries secure the compensation they deserve. Our experienced team provides comprehensive legal support to guide you through the personal injury claims process under Queensland law.",
  "intro_p2" => "Personal injury claims in Queensland are governed by the <strong>Personal Injuries Proceedings Act 2002 (Qld)</strong>. This Act sets out the procedures and requirements for making a personal injury claim, ensuring that claims are handled efficiently and fairly.",
  "intro_p3" => "We handle claims arising from motor vehicle accidents, workplace accidents, public liability incidents, medical negligence, and defective products.",
  "types_title" => "Types of Personal Injury Claims",
  "types_subtitle" => "We handle a wide range of claims",
  "types" => [
    ["icon"=>"&#x1F697;", "title"=>"Motor Vehicle Accidents", "desc"=>"Injuries sustained in car, motorcycle, bicycle, and pedestrian accidents caused by another party's negligence."],
    ["icon"=>"&#x1F3D7;", "title"=>"Workplace Accidents", "desc"=>"Injuries arising from incidents at work, including slips, trips, falls, and exposure to hazardous conditions."],
    ["icon"=>"&#x1F3EA;", "title"=>"Public Liability", "desc"=>"Injuries occurring in public places such as parks, shopping centres, and restaurants due to negligence."],
    ["icon"=>"&#x1F3E5;", "title"=>"Medical Negligence", "desc"=>"Harm caused by medical malpractice or negligence by healthcare providers, including misdiagnosis and surgical errors."],
    ["icon"=>"&#x1F4E6;", "title"=>"Product Liability", "desc"=>"Injuries resulting from defective or dangerous products sold to consumers."],
  ],
  "damages_title" => "Costs and Damages You Can Claim",
  "damages_subtitle" => "What compensation may be available to you",
  "damages" => [
    ["icon"=>"&#x1F48A;", "title"=>"Medical Expenses", "desc"=>"Reimbursement for past and future medical treatment related to the injury."],
    ["icon"=>"&#x1F4B0;", "title"=>"Loss of Earnings", "desc"=>"Compensation for lost wages and potential future earnings due to the inability to work."],
    ["icon"=>"&#x1F494;", "title"=>"Pain and Suffering", "desc"=>"Damages for physical pain and emotional distress caused by the injury."],
    ["icon"=>"&#x1F932;", "title"=>"Care and Assistance", "desc"=>"Costs for care and assistance provided by family members or professional carers."],
    ["icon"=>"&#x1F9FE;", "title"=>"Out-of-Pocket Expenses", "desc"=>"Reimbursement for additional expenses such as travel costs for medical appointments."],
    ["icon"=>"&#x1F305;", "title"=>"Loss of Enjoyment of Life", "desc"=>"Compensation for the impact of the injury on your ability to enjoy life and usual activities."],
  ],
  "faq" => [
    ["q"=>"How long do I have to make a personal injury claim in Queensland?", "a"=>"Generally, you have 3 years from the date of injury to commence court proceedings. However, strict pre-court procedures under the Personal Injuries Proceedings Act 2002 must be followed first, so it is important to seek legal advice as early as possible."],
    ["q"=>"What if the accident was partly my fault?", "a"=>"You may still be entitled to compensation even if you were partially at fault. Under Queensland law, your compensation may be reduced by a percentage reflecting your contributory negligence, but you can still receive a significant payout."],
    ["q"=>"Do I need to go to court?", "a"=>"Not necessarily. Most personal injury claims are settled through negotiation without going to court. However, if a fair settlement cannot be reached, our experienced litigators will represent you in court."],
    ["q"=>"How much will it cost me?", "a"=>"We offer competitive, transparent pricing and in many cases a No Win, No Fee arrangement. Contact us for a free initial consultation to discuss your options."],
  ],
  "cta_title" => "Injured? Let Us Fight For You",
  "cta_desc" => "Book a consultation with our experienced personal injury lawyers and find out what compensation you may be entitled to.",
];

$page_data[2518] = [
  "title" => "Medical Negligence Claims",
  "subtitle" => "Holding Healthcare Providers Accountable",
  "hero_desc" => "If you have suffered harm due to medical malpractice or negligence, our experienced team will guide you through the claims process and fight to secure the compensation you deserve.",
  "icon" => "&#x1F3E5;",
  "intro_heading" => "Expert Legal Support for <span>Medical Negligence</span>",
  "intro_p1" => "If you have suffered harm due to medical malpractice or negligence, <strong>OneStop Legal</strong> is here to help. Our experienced team provides expert legal support to ensure you receive the compensation you deserve.",
  "intro_p2" => "Under the <strong>Queensland Personal Injuries Proceedings Act 2002</strong>, strict procedures must be followed when making a medical negligence claim. Our team will guide you through every step of this process, ensuring compliance with all legal requirements.",
  "intro_p3" => "We understand the complexities of medical negligence cases and are dedicated to achieving the best possible outcome for you.",
  "types_title" => "Types of Medical Negligence",
  "types_subtitle" => "Common situations we can help with",
  "types" => [
    ["icon"=>"&#x1F50D;", "title"=>"Misdiagnosis", "desc"=>"When a healthcare provider fails to correctly diagnose a condition, leading to delayed or incorrect treatment and further harm."],
    ["icon"=>"&#x1F52A;", "title"=>"Surgical Errors", "desc"=>"Mistakes made during surgery, including wrong-site surgery, nerve damage, or complications caused by substandard care."],
    ["icon"=>"&#x1F48A;", "title"=>"Medication Errors", "desc"=>"Prescribing the wrong medication, incorrect dosage, or failing to account for drug interactions that cause patient harm."],
    ["icon"=>"&#x1F6AB;", "title"=>"Failure to Treat", "desc"=>"When a healthcare provider fails to provide appropriate treatment for a diagnosed condition, leading to worsened outcomes."],
    ["icon"=>"&#x1F476;", "title"=>"Birth Injuries", "desc"=>"Injuries to mother or baby during pregnancy, labour, or delivery caused by negligent medical care."],
    ["icon"=>"&#x26A0;", "title"=>"Lack of Informed Consent", "desc"=>"Failing to adequately inform a patient of the risks, alternatives, and consequences of a medical procedure before obtaining consent."],
  ],
  "damages_title" => "Costs and Damages You Can Claim",
  "damages_subtitle" => "What compensation may be available to you",
  "damages" => [
    ["icon"=>"&#x1F48A;", "title"=>"Medical Expenses", "desc"=>"Reimbursement for past and future medical treatment related to the injury."],
    ["icon"=>"&#x1F4B0;", "title"=>"Loss of Earnings", "desc"=>"Compensation for lost wages and potential future earnings."],
    ["icon"=>"&#x1F494;", "title"=>"Pain and Suffering", "desc"=>"Damages for physical pain and emotional distress caused by negligence."],
    ["icon"=>"&#x1F932;", "title"=>"Care and Assistance", "desc"=>"Costs for care and assistance provided by family members or professional carers."],
    ["icon"=>"&#x1F9FE;", "title"=>"Out-of-Pocket Expenses", "desc"=>"Reimbursement for additional expenses such as travel costs for medical appointments."],
    ["icon"=>"&#x1F491;", "title"=>"Loss of Consortium", "desc"=>"Compensation for the impact of the injury on your relationship with your spouse or partner."],
  ],
  "faq" => [
    ["q"=>"How do I know if I have a medical negligence claim?", "a"=>"You may have a claim if a healthcare provider failed to meet the expected standard of care and that failure caused you harm. Contact us for a free consultation and we will assess your situation."],
    ["q"=>"How long do I have to make a claim?", "a"=>"In Queensland, you generally have 3 years from the date you became aware of the injury. However, pre-court procedures must be followed first, so seek legal advice as soon as possible."],
    ["q"=>"Are medical negligence claims hard to prove?", "a"=>"Medical negligence cases can be complex and often require expert medical evidence. Our experienced team works with medical experts to build a strong case on your behalf."],
    ["q"=>"What does it cost to pursue a medical negligence claim?", "a"=>"We offer transparent pricing and in many cases No Win, No Fee arrangements. Contact us for a free initial consultation to discuss your options."],
  ],
  "cta_title" => "Suffered Medical Negligence?",
  "cta_desc" => "Book a consultation with our experienced lawyers and find out how we can help you seek justice and compensation.",
];

$page_data[2553] = [
  "title" => "Workers Compensation",
  "subtitle" => "Protecting Injured Workers Rights",
  "hero_desc" => "If you have been injured at work or developed an illness due to your employment, you may be entitled to workers compensation. Our experienced lawyers will help you navigate the claims process and secure the benefits you deserve.",
  "icon" => "&#x1F3D7;",
  "intro_heading" => "Expert Legal Support for <span>Workers Compensation</span>",
  "intro_p1" => "At <strong>OneStop Legal</strong>, we are dedicated to helping injured workers secure the compensation they deserve. Our experienced team provides comprehensive legal support to guide you through the workers compensation claims process under Queensland law.",
  "intro_p2" => "Workers compensation claims in Queensland are governed by the <strong>Workers Compensation and Rehabilitation Act 2003</strong>. This Act provides a framework for compensating workers who suffer injuries or diseases arising out of or in the course of their employment.",
  "intro_p3" => "It covers various types of injuries, including those caused by accidents, occupational diseases, and exposure to hazardous substances like asbestos and dust.",
  "types_title" => "Who Can Claim?",
  "types_subtitle" => "Eligibility under Queensland law",
  "types" => [
    ["icon"=>"&#x1F477;", "title"=>"Employees", "desc"=>"Full-time, part-time, and casual employees who suffer a work-related injury or illness."],
    ["icon"=>"&#x1F4DA;", "title"=>"Apprentices and Trainees", "desc"=>"Individuals undergoing formal training or apprenticeship programs who are injured during their work."],
    ["icon"=>"&#x1F527;", "title"=>"Contractors", "desc"=>"In some cases, contractors and subcontractors may be covered if they are deemed to be workers under the Act."],
    ["icon"=>"&#x1F46A;", "title"=>"Dependents", "desc"=>"Family members or dependents of a worker who has died as a result of a work-related injury or illness."],
  ],
  "damages_title" => "Costs and Damages You Can Claim",
  "damages_subtitle" => "What compensation may be available to you",
  "damages" => [
    ["icon"=>"&#x1F48A;", "title"=>"Medical Expenses", "desc"=>"Reimbursement for past and future medical treatment related to the injury or illness."],
    ["icon"=>"&#x1F4B0;", "title"=>"Loss of Earnings", "desc"=>"Compensation for lost wages and potential future earnings due to the inability to work."],
    ["icon"=>"&#x1F504;", "title"=>"Rehabilitation Costs", "desc"=>"Expenses for rehabilitation and support services to help you recover and return to work."],
    ["icon"=>"&#x1F4CB;", "title"=>"Permanent Impairment", "desc"=>"Compensation for permanent injuries that impact your ability to work and perform daily activities."],
    ["icon"=>"&#x1F494;", "title"=>"Pain and Suffering", "desc"=>"Damages for physical pain and emotional distress caused by the injury or illness."],
    ["icon"=>"&#x1F932;", "title"=>"Care and Assistance", "desc"=>"Costs for care and assistance provided by family members or professional carers."],
  ],
  "faq" => [
    ["q"=>"What should I do if I am injured at work?", "a"=>"Report the injury to your employer immediately, seek medical treatment, and contact a workers compensation lawyer as soon as possible to understand your rights and options."],
    ["q"=>"Can I claim if the injury was partly my fault?", "a"=>"Yes, workers compensation in Queensland is a no-fault scheme, meaning you can claim regardless of who was at fault for the injury."],
    ["q"=>"What if my claim is denied?", "a"=>"If your claim is denied, you have the right to appeal. Our experienced lawyers can help you challenge the decision and fight for the benefits you are entitled to."],
    ["q"=>"How long do I have to make a claim?", "a"=>"You should notify your employer of the injury as soon as possible, ideally within 6 months. Delays can affect your claim, so seek legal advice early."],
  ],
  "cta_title" => "Injured at Work? We Can Help",
  "cta_desc" => "Book a consultation with our experienced workers compensation lawyers today.",
];

$page_data[2546] = [
  "title" => "Superannuation and TPD Claims",
  "subtitle" => "Securing the Benefits You Are Entitled To",
  "hero_desc" => "If you are unable to work due to a total and permanent disability, you may be entitled to a significant lump sum payment from your superannuation fund. We will help you navigate the claims process.",
  "icon" => "&#x1F4BC;",
  "intro_heading" => "Expert Legal Support for <span>Superannuation and TPD Claims</span>",
  "intro_p1" => "At <strong>OneStop Legal</strong>, we are committed to helping individuals secure the benefits they are entitled to through their superannuation and Total and Permanent Disability (TPD) insurance.",
  "intro_p2" => "<strong>Superannuation</strong> is a long-term savings arrangement designed to help you accumulate funds for retirement. Most superannuation funds include insurance for TPD, which provides financial support if you are unable to work due to a total and permanent disability.",
  "intro_p3" => "<strong>TPD insurance</strong> pays a lump sum benefit if you are deemed totally and permanently disabled and unable to work in your usual occupation or any occupation for which you are suited by education, training, or experience.",
  "types_title" => "Who Can Claim?",
  "types_subtitle" => "You may be eligible if...",
  "types" => [
    ["icon"=>"&#x1F4CB;", "title"=>"Super Fund Member", "desc"=>"You are a member of a superannuation fund that provides TPD insurance as part of its membership benefits."],
    ["icon"=>"&#x1F489;", "title"=>"Injury or Illness", "desc"=>"You have suffered an injury or illness that results in you being unable to work in your usual occupation or any suitable occupation."],
    ["icon"=>"&#x1F512;", "title"=>"Permanent Condition", "desc"=>"Your disability is deemed total and permanent, meaning there is no likelihood of you returning to work in the future."],
  ],
  "damages_title" => "Benefits You Can Claim",
  "damages_subtitle" => "What you may be entitled to",
  "damages" => [
    ["icon"=>"&#x1F4B0;", "title"=>"Lump Sum Payment", "desc"=>"A one-time lump sum payment from your superannuation fund if you meet the TPD criteria."],
    ["icon"=>"&#x1F4C8;", "title"=>"Ongoing Super Contributions", "desc"=>"Some policies may continue to make superannuation contributions on your behalf."],
    ["icon"=>"&#x1F6E1;", "title"=>"Additional Insurance Benefits", "desc"=>"Depending on your policy, you may also be eligible for income protection or death benefits."],
  ],
  "faq" => [
    ["q"=>"What is the difference between TPD and income protection?", "a"=>"TPD provides a lump sum payment if you are permanently unable to work, while income protection provides regular payments to replace your income while you are temporarily unable to work."],
    ["q"=>"How long does a TPD claim take?", "a"=>"TPD claims can take several months to process, depending on the complexity of your case and the responsiveness of your super fund. Having a lawyer can help expedite the process."],
    ["q"=>"What if my TPD claim is rejected?", "a"=>"If your claim is rejected, you have the right to appeal the decision. Our experienced lawyers can help you challenge the rejection and pursue your entitlements."],
    ["q"=>"Do I need a lawyer for a TPD claim?", "a"=>"While not mandatory, having a lawyer significantly increases your chances of a successful claim. We understand the process, handle the paperwork, and negotiate with super funds on your behalf."],
  ],
  "cta_title" => "Unable to Work? Claim What You Are Owed",
  "cta_desc" => "Book a consultation with our experienced lawyers and find out if you are entitled to a TPD payout.",
];

$page_data[2540] = [
  "title" => "Public Liability Claims",
  "subtitle" => "Injured in a Public Place? We Can Help",
  "hero_desc" => "If you have been injured in a public place due to someone else's negligence, whether a slip, trip, fall, or other accident, you may be entitled to compensation. Our experienced lawyers are here to help.",
  "icon" => "&#x1F3EA;",
  "intro_heading" => "Expert Legal Support for <span>Public Liability Claims</span>",
  "intro_p1" => "If you have been injured in a public place due to someone else's negligence, <strong>OneStop Legal</strong> is here to help. Our experienced team provides expert legal support to ensure you receive the compensation you deserve.",
  "intro_p2" => "Under the <strong>Queensland Personal Injuries Proceedings Act 2002</strong>, strict procedures must be followed when making a public liability claim. Our team will guide you through every step of this process.",
  "intro_p3" => "We understand the complexities of public liability cases and are dedicated to achieving the best possible outcome for you.",
  "types_title" => "Areas Covered",
  "types_subtitle" => "Common public liability situations",
  "types" => [
    ["icon"=>"&#x1F6B6;", "title"=>"Slip and Fall Accidents", "desc"=>"Injuries from slipping, tripping, or falling on wet floors, uneven surfaces, or poorly maintained premises."],
    ["icon"=>"&#x1F3DE;", "title"=>"Public Place Accidents", "desc"=>"Injuries in parks, footpaths, car parks, shopping centres, and other public areas."],
    ["icon"=>"&#x26BD;", "title"=>"Sporting and Recreation", "desc"=>"Injuries at sporting events, gyms, pools, and recreational facilities caused by negligence."],
    ["icon"=>"&#x1F415;", "title"=>"Animal Attacks", "desc"=>"Injuries caused by dog bites or other animal attacks where the owner was negligent."],
    ["icon"=>"&#x1F3E0;", "title"=>"Rental Property Accidents", "desc"=>"Injuries in rental properties caused by the landlord's failure to maintain safe conditions."],
    ["icon"=>"&#x1F3EB;", "title"=>"School and Daycare", "desc"=>"Injuries to children at schools and daycare centres caused by inadequate supervision or unsafe conditions."],
  ],
  "damages_title" => "Costs and Damages You Can Claim",
  "damages_subtitle" => "What compensation may be available to you",
  "damages" => [
    ["icon"=>"&#x1F48A;", "title"=>"Medical Expenses", "desc"=>"Reimbursement for past and future medical treatment related to the injury."],
    ["icon"=>"&#x1F4B0;", "title"=>"Loss of Earnings", "desc"=>"Compensation for lost wages and potential future earnings."],
    ["icon"=>"&#x1F494;", "title"=>"Pain and Suffering", "desc"=>"Damages for physical pain and emotional distress caused by negligence."],
    ["icon"=>"&#x1F932;", "title"=>"Care and Assistance", "desc"=>"Costs for care and assistance provided by family members or professional carers."],
    ["icon"=>"&#x1F9FE;", "title"=>"Out-of-Pocket Expenses", "desc"=>"Reimbursement for additional expenses such as travel costs for medical appointments."],
    ["icon"=>"&#x1F305;", "title"=>"Loss of Enjoyment of Life", "desc"=>"Compensation for the impact of the injury on your ability to enjoy life and usual activities."],
  ],
  "faq" => [
    ["q"=>"What is public liability?", "a"=>"Public liability refers to the legal responsibility of individuals, businesses, or organisations to ensure their premises or activities are safe for the public. If negligence causes injury, the responsible party may be liable for compensation."],
    ["q"=>"How do I prove negligence in a public liability claim?", "a"=>"You need to show that the responsible party owed you a duty of care, breached that duty, and that breach directly caused your injury. Evidence such as photos, witness statements, and incident reports are crucial."],
    ["q"=>"How long do I have to make a public liability claim?", "a"=>"In Queensland, you generally have 3 years from the date of injury. However, pre-court procedures must be initiated earlier, so seek legal advice as soon as possible."],
    ["q"=>"What if I was partly at fault?", "a"=>"You may still be entitled to compensation, but it may be reduced by a percentage reflecting your contributory negligence."],
  ],
  "cta_title" => "Injured in a Public Place?",
  "cta_desc" => "Book a consultation and find out what compensation you may be entitled to.",
];

$page_data[2532] = [
  "title" => "Product Liability Claims",
  "subtitle" => "Injured by a Defective Product? We Will Fight For You",
  "hero_desc" => "If you have been injured by a defective or dangerous product, you may be entitled to compensation from the manufacturer, distributor, or retailer. Our experienced lawyers will help you pursue your claim.",
  "icon" => "&#x1F4E6;",
  "intro_heading" => "Expert Legal Support for <span>Product Liability Claims</span>",
  "intro_p1" => "At <strong>OneStop Legal</strong>, we provide comprehensive legal support for product liability claims under the <strong>Australian Consumer Law (ACL)</strong>.",
  "intro_p2" => "The ACL, found in Schedule 2 of the <strong>Competition and Consumer Act 2010 (Cth)</strong>, provides a framework for ensuring that products sold to consumers are safe and meet certain standards. It includes provisions for consumer guarantees, safety standards, and liability for defective goods.",
  "intro_p3" => "Our experienced team is dedicated to helping you secure the compensation you deserve for injuries caused by defective or dangerous products.",
  "types_title" => "Key Aspects of Consumer Law",
  "types_subtitle" => "Your rights under Australian Consumer Law",
  "types" => [
    ["icon"=>"&#x2705;", "title"=>"Consumer Guarantees", "desc"=>"Products must be safe, durable, free from defects, and fit for their intended purpose. If not, consumers have the right to seek repair, replacement, or refund."],
    ["icon"=>"&#x1F6E1;", "title"=>"Product Safety", "desc"=>"The ACL imposes strict safety requirements on manufacturers and suppliers. Products must comply with mandatory safety standards."],
    ["icon"=>"&#x2696;", "title"=>"Liability for Defective Goods", "desc"=>"Manufacturers and suppliers can be held liable if a product is found to be defective and causes injury or loss to the consumer."],
  ],
  "damages_title" => "Costs and Damages You Can Claim",
  "damages_subtitle" => "What compensation may be available to you",
  "damages" => [
    ["icon"=>"&#x1F48A;", "title"=>"Medical Expenses", "desc"=>"Reimbursement for past and future medical treatment related to the injury."],
    ["icon"=>"&#x1F4B0;", "title"=>"Loss of Earnings", "desc"=>"Compensation for lost wages and potential future earnings due to the inability to work."],
    ["icon"=>"&#x1F494;", "title"=>"Pain and Suffering", "desc"=>"Damages for physical pain and emotional distress caused by the injury."],
    ["icon"=>"&#x1F932;", "title"=>"Care and Assistance", "desc"=>"Costs for care and assistance provided by family members or professional carers."],
    ["icon"=>"&#x1F9FE;", "title"=>"Out-of-Pocket Expenses", "desc"=>"Reimbursement for additional expenses such as travel costs for medical appointments."],
    ["icon"=>"&#x1F305;", "title"=>"Loss of Enjoyment of Life", "desc"=>"Compensation for the impact of the injury on your ability to enjoy life and usual activities."],
  ],
  "faq" => [
    ["q"=>"What makes a product defective?", "a"=>"A product is considered defective if it has a manufacturing defect, a design defect, or inadequate warnings or instructions that make it unsafe for its intended use."],
    ["q"=>"Who can I claim against?", "a"=>"You can claim against the manufacturer, importer, distributor, or retailer of the defective product under Australian Consumer Law."],
    ["q"=>"How long do I have to make a product liability claim?", "a"=>"Generally, you have 3 years from the date you became aware of the injury. There is also a 10-year limitation period from when the product was supplied. Seek legal advice as soon as possible."],
    ["q"=>"Do I need to prove the manufacturer was negligent?", "a"=>"Under the ACL, product liability is a strict liability regime, meaning you do not need to prove the manufacturer was negligent, only that the product was defective and caused your injury."],
  ],
  "cta_title" => "Injured by a Defective Product?",
  "cta_desc" => "Book a consultation and find out how we can help you pursue compensation.",
];

$page_data[2499] = [
  "title" => "Asbestos and Dust Disease Claims",
  "subtitle" => "Fighting for Victims of Asbestos Exposure",
  "hero_desc" => "Exposure to asbestos and harmful dust can lead to devastating health conditions. Our experienced lawyers are here to help you secure the compensation you deserve for asbestos-related diseases and dust-related conditions.",
  "icon" => "&#x1FAC1;",
  "intro_heading" => "Expert Legal Support for <span>Asbestos and Dust Disease</span>",
  "intro_p1" => "At <strong>OneStop Legal</strong>, we are committed to helping individuals who have suffered from asbestos-related diseases or other dust-related conditions to secure the compensation they deserve.",
  "intro_p2" => "In Queensland, asbestos and dust-related compensation claims are primarily covered under the <strong>Workers Compensation and Rehabilitation Act 2003</strong> and the <strong>Personal Injuries Proceedings Act 2002</strong>.",
  "intro_p3" => "These acts outline the legal framework for pursuing compensation for injuries and diseases, including those caused by asbestos and other harmful dust exposure in the workplace.",
  "types_title" => "Diseases We Cover",
  "types_subtitle" => "Asbestos and dust-related conditions",
  "types" => [
    ["icon"=>"&#x1FAC1;", "title"=>"Mesothelioma", "desc"=>"A rare and aggressive cancer caused by asbestos exposure, affecting the lining of the lungs, abdomen, or heart."],
    ["icon"=>"&#x1FAC1;", "title"=>"Asbestosis", "desc"=>"A chronic lung disease caused by inhaling asbestos fibres, leading to scarring of lung tissue and breathing difficulties."],
    ["icon"=>"&#x1F52C;", "title"=>"Lung Cancer", "desc"=>"Asbestos exposure significantly increases the risk of developing lung cancer, particularly in combination with smoking."],
    ["icon"=>"&#x2692;", "title"=>"Silicosis", "desc"=>"A lung disease caused by inhaling crystalline silica dust, common in mining, construction, and stone cutting industries."],
    ["icon"=>"&#x1F4A8;", "title"=>"COPD", "desc"=>"Chronic obstructive pulmonary disease caused by prolonged exposure to harmful dust and particles in the workplace."],
    ["icon"=>"&#x1F3ED;", "title"=>"Other Respiratory Conditions", "desc"=>"Other respiratory conditions caused by dust exposure in industrial and occupational settings."],
  ],
  "damages_title" => "Costs and Damages You Can Claim",
  "damages_subtitle" => "What compensation may be available to you",
  "damages" => [
    ["icon"=>"&#x1F48A;", "title"=>"Medical Expenses", "desc"=>"Reimbursement for past and future medical treatment related to the disease."],
    ["icon"=>"&#x1F4B0;", "title"=>"Loss of Earnings", "desc"=>"Compensation for lost wages and potential future earnings."],
    ["icon"=>"&#x1F494;", "title"=>"Pain and Suffering", "desc"=>"Damages for physical pain and emotional distress caused by the disease."],
    ["icon"=>"&#x1F932;", "title"=>"Care and Assistance", "desc"=>"Costs for care and assistance provided by family members or professional carers."],
    ["icon"=>"&#x1F9FE;", "title"=>"Out-of-Pocket Expenses", "desc"=>"Reimbursement for additional expenses such as travel costs for medical appointments."],
    ["icon"=>"&#x1F305;", "title"=>"Loss of Enjoyment of Life", "desc"=>"Compensation for the impact of the disease on your ability to enjoy life and usual activities."],
  ],
  "faq" => [
    ["q"=>"How do I know if I was exposed to asbestos?", "a"=>"Asbestos was widely used in Australian construction, manufacturing, and mining until the late 1980s. If you worked in these industries or lived in older buildings, you may have been exposed. A medical assessment can confirm related conditions."],
    ["q"=>"How long after exposure can symptoms appear?", "a"=>"Asbestos-related diseases can take 10 to 40 years to develop after initial exposure. If you have a history of exposure, regular health monitoring is recommended."],
    ["q"=>"Can I claim if my employer no longer exists?", "a"=>"Yes. There are mechanisms in place to pursue claims even if the responsible employer has ceased to exist, including claims against insurers and government schemes."],
    ["q"=>"Is there a time limit on asbestos claims?", "a"=>"Time limits vary depending on the type of claim and when you became aware of your condition. In some cases, special provisions extend the limitation period for dust disease claims. Seek legal advice as soon as possible."],
  ],
  "cta_title" => "Affected by Asbestos or Dust Disease?",
  "cta_desc" => "Book a consultation with our experienced lawyers and find out what compensation you may be entitled to.",
];

$current_id = get_the_ID();
$data = isset($page_data[$current_id]) ? $page_data[$current_id] : null;

if (!$data) {
  echo '<div style="padding:100px 20px;text-align:center;"><h2>Page template not configured for this page.</h2></div>';
  get_footer();
  return;
}
?>


<section class="svc-back">
  <div class="svc-container">
    <a href="/compensation/">&larr; Back to All Compensation Services</a>
  </div>
</section>

<section class="svc-hero">
  <div class="svc-container">
    <h1><?php echo $data["title"]; ?></h1>
    <p class="hero-subtitle"><?php echo $data["subtitle"]; ?></p>
    <p class="hero-description"><?php echo $data["hero_desc"]; ?></p>
    <p style="font-size:14px;color:#ff9f43;font-weight:600;margin-bottom:20px;">⚠️ Time limits apply — seek legal advice as soon as possible</p>
    <div style="display:flex;gap:15px;justify-content:center;flex-wrap:wrap;margin-bottom:15px;">
      <a href="/book/" class="hero-cta">📅 Book a Consultation</a>
      <a href="tel:+61731561216" class="hero-cta" style="background:rgba(255,255,255,0.1);color:#fff;border:2px solid rgba(255,255,255,0.3);"><span class="btn-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></span><span class="btn-text">+61 7 3156 1216</span></a>
    </div>
    <div style="display:flex;gap:20px;justify-content:center;flex-wrap:wrap;">
      <span style="font-size:13px;color:rgba(255,255,255,0.7);">✅ No Win, No Fee</span>
      <span style="font-size:13px;color:rgba(255,255,255,0.7);">🔒 Confidential</span>
      <span style="font-size:13px;color:rgba(255,255,255,0.7);">⚡ Free Consultation</span>
    </div>
  </div>
</section>

<section class="svc-estimator" style="padding:70px 0;background:#f8f6f0;">
  <div class="svc-container">
    <div style="text-align:center;margin-bottom:40px;">
      <h2 style="font-family:'Playfair Display',serif;font-size:36px;color:#0d1b3e;margin-bottom:10px;">What Is Your Claim Worth?</h2>
      <p style="font-size:17px;color:#666;">Get an instant estimate — free, confidential, no obligation</p>
    </div>
    <?php echo do_shortcode('[osl_claim_estimator]'); ?>
  </div>
</section>

<section class="svc-intro">
  <div class="svc-container">
    <div class="svc-intro-grid">
      <div class="svc-intro-text">
        <h2><?php echo $data["intro_heading"]; ?></h2>
        <p><?php echo $data["intro_p1"]; ?></p>
        <p><?php echo $data["intro_p2"]; ?></p>
        <p><?php echo $data["intro_p3"]; ?></p>
      </div>
      <div class="svc-intro-image">
        <div class="intro-icon"><?php echo $data["icon"]; ?></div>
      </div>
    </div>
  </div>
</section>

<section class="svc-types">
  <div class="svc-container">
    <div class="section-title">
      <h2><?php echo $data["types_title"]; ?></h2>
      <p><?php echo $data["types_subtitle"]; ?></p>
    </div>
    <div class="types-grid">
      <?php foreach ($data["types"] as $type): ?>
      <div class="type-card">
        <div class="type-icon"><?php echo $type["icon"]; ?></div>
        <h3><?php echo $type["title"]; ?></h3>
        <p><?php echo $type["desc"]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="svc-damages">
  <div class="svc-container">
    <div class="section-title">
      <h2><?php echo $data["damages_title"]; ?></h2>
      <p><?php echo $data["damages_subtitle"]; ?></p>
    </div>
    <div class="damages-grid">
      <?php foreach ($data["damages"] as $damage): ?>
      <div class="damage-card">
        <div class="damage-icon"><?php echo $damage["icon"]; ?></div>
        <h3><?php echo $damage["title"]; ?></h3>
        <p><?php echo $damage["desc"]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="svc-services">
  <div class="svc-container">
    <div class="section-title">
      <h2>Our Key Services</h2>
      <p>How we support your claim</p>
    </div>
    <div class="services-grid">
      <div class="service-card">
        <div class="service-icon">&#x1F50D;</div>
        <div>
          <h3>Thorough Case Evaluation</h3>
          <p>Assessing the merits of your case and advising on the best course of action.</p>
        </div>
      </div>
      <div class="service-card">
        <div class="service-icon">&#x1F4AC;</div>
        <div>
          <h3>Expert Consultation and Advice</h3>
          <p>Providing clear and informed guidance throughout the claims process.</p>
        </div>
      </div>
      <div class="service-card">
        <div class="service-icon">&#x1F4DD;</div>
        <div>
          <h3>Claim Preparation and Filing</h3>
          <p>Ensuring all necessary documentation is accurately prepared and submitted.</p>
        </div>
      </div>
      <div class="service-card">
        <div class="service-icon">&#x2696;</div>
        <div>
          <h3>Vigorous Representation</h3>
          <p>Representing you in negotiations and court proceedings to secure the best possible outcome.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="svc-faq">
  <div class="svc-container">
    <div class="section-title">
      <h2>Frequently Asked Questions</h2>
      <p>Common questions about <?php echo strtolower($data["title"]); ?></p>
    </div>
    <div class="faq-list">
      <?php foreach ($data["faq"] as $faq): ?>
      <div class="faq-item">
        <div class="faq-question">
          <span><?php echo $faq["q"]; ?></span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer"><?php echo $faq["a"]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<section class="svc-cta">
  <div class="svc-container">
    <h2><?php echo $data["cta_title"]; ?></h2>
    <p><?php echo $data["cta_desc"]; ?></p>
    <div class="svc-cta-buttons">
      <a href="/book/" class="btn-primary">Book a Consultation</a>
      <a href="tel:+61731561216" class="btn-secondary" btn-phone><span class="btn-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></span><span class="btn-text">+61 7 3156 1216</span></a>
    </div>
  </div>
</section>

<script>
document.querySelectorAll(".faq-question").forEach(function(q){
  q.addEventListener("click",function(){
    var item=this.parentElement;
    var wasActive=item.classList.contains("active");
    document.querySelectorAll(".faq-item").forEach(function(i){i.classList.remove("active")});
    if(!wasActive) item.classList.add("active");
  });
});
</script>

<?php get_footer(); ?>